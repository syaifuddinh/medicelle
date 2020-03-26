<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;
use App\Price;
use App\Permission;
use App\MedicalRecord;
use App\StockTransaction;
use Str;
use DB;
use Exception;
use Carbon\Carbon;


class MedicalRecordDetail extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['medical_record_id', 'disease_id', 'disease_name', 'name', 'duration', 'cure', 'last_checkup_date', 'pain_type', 'is_other_pain_type', 'pain_location', 'pain_duration', 'emergence_time', 'side_effect', 'is_allergy_history', 'is_disease_history', 'is_family_disease_history', 'is_pain_history', 'is_pain_cure_history', 'is_unknown', 'is_kid_history','is_pregnant_week_age','kid_order','partus_year','partus_location','pregnant_month_age','pregnant_week_age','birth_type','birth_helper','birth_obstacle','weight','long','komplikasi_nifas', 'baby_gender', 'is_imunisasi_history','is_other_imunisasi','is_imunisasi_month_age','imunisasi_month_age','imunisasi_year_age','imunisasi','reaksi_imunisasi', 'is_ginekologi_history', 'is_other_ginekologi', 'is_obgyn_disease_history', 'is_obgyn_family_disease_history', 'is_kb_history', 'is_komplikasi_kb_history', 'is_diagnose_history', 'type', 'description', 'is_other', 'is_drug', 'is_bhp', 'is_treatment', 'is_treatment_group', 'is_diagnostic', 'item_id', 'qty', 'reduksi', 'date', 'result_date', 'signa1', 'signa2', 'lokasi_id', 'kanan', 'kiri', 'kesimpulan', 'saran', 'additional'
    ];
    protected $appends = ['filename', 'additional'];

    public static function boot() {
        parent::boot();

        static::creating(function(MedicalRecordDetail $medicalRecordDetail){
            if($medicalRecordDetail->is_drug == 1) {
                $stock = DB::table('stocks')
                ->whereItemId($medicalRecordDetail->item_id)
                ->whereRaw('NOW() < expired_date')
                ->sum('qty');

                if($medicalRecordDetail->qty > $stock) {
                    throw new Exception('Stok tidak mencukupi !');
                }
            }

            if($medicalRecordDetail->is_bhp == 1) {
                $stock = DB::table('stocks')
                ->whereItemId($medicalRecordDetail->item_id)
                ->whereLokasiId($medicalRecordDetail->lokasi_id)
                ->sum('qty');

                if($medicalRecordDetail->qty > $stock) {
                    throw new Exception('Stok tidak mencukupi !');
                } else {
                    $stockTransaction = StockTransaction::create([
                        'date' => Carbon::now()->format('Y-m-d'),
                        'description' => 'Penggunaan BHP pada pemeriksaan pasien',
                        'item_id' => $medicalRecordDetail->item_id,
                        'in_qty' => 0,
                        'out_qty' => $medicalRecordDetail->qty,
                        'lokasi_id' => $medicalRecordDetail->lokasi_id,
                    ]);

                }
            }
        });
        
        static::created(function(MedicalRecordDetail $medicalRecordDetail){
                $cure = DB::table('medical_record_details')
                ->join('items', 'medical_record_details.item_id', 'items.id')
                ->join('pieces', 'pieces.id', 'items.piece_id')
                ->whereIsDrug(1)
                ->whereMedicalRecordId($medicalRecordDetail->medical_record_id)
                ->selectRaw("ARRAY_TO_STRING(ARRAY_AGG( CONCAT(items.name, ' sebanyak ', medical_record_details.qty, ' ', pieces.name) ), ', ') AS component")
                ->first();
                $medical_record = MedicalRecord::find($medicalRecordDetail->medical_record_id);
                $registration_detail_id = $medical_record->registration_detail_id;
                $additional = $medical_record->additional;
                $additional->histopatologi_terapi = $cure->component;
                $medical_record->additional = $additional;
                $medical_record->save();

                if($medicalRecordDetail->is_treatment == 1) {
                    $price = DB::table('prices')
                    ->whereItemId($medicalRecordDetail->item_id)
                    ->first();
                    if($price->destination == 'RUANG TINDAKAN') {
                        DB::table('pivot_medical_records')
                        ->insert([
                            'medical_record_id' => $medicalRecordDetail->medical_record_id,
                            'registration_detail_id' => $registration_detail_id,
                            'is_referenced' => 1,
                            'is_ruang_tindakan' => 1,
                            'medical_record_detail_id' => $medicalRecordDetail->id
                        ]);
                    }
                }

                $price = DB::table('prices')
                ->whereItemId($medicalRecordDetail->item_id)
                ->first();
                if($medicalRecordDetail->is_diagnostic == 1) {
                    if($price->radiology_group != null) {
                        DB::table('pivot_medical_records')
                        ->insert([
                            'medical_record_id' => $medicalRecordDetail->medical_record_id,
                            'registration_detail_id' => $registration_detail_id,
                            'is_referenced' => 1,
                            'is_radiology' => 1,
                            'medical_record_detail_id' => $medicalRecordDetail->id
                        ]);
                    }

                    if($price->is_chemoterapy == 1) {
                        DB::table('pivot_medical_records')
                        ->insert([
                            'medical_record_id' => $medicalRecordDetail->medical_record_id,
                            'registration_detail_id' => $registration_detail_id,
                            'is_referenced' => 1,
                            'is_chemoterapy' => 1,
                            'medical_record_detail_id' => $medicalRecordDetail->id
                        ]);
                    }

                    $price = Price::find($price->id);
                    if($price->laboratory_treatment()->count('id') > 0) {
                           $checklist = [];
                           $laboratory_treatment = $price->laboratory_treatment;
                           foreach($laboratory_treatment as $treatment) {
                                $laboratory_type = DB::table('laboratory_types')
                                ->whereId($treatment->laboratory_type_id)
                                ->first();
                                $laboratory_type_detail = DB::table('laboratory_type_details')
                                ->whereLaboratoryTypeId($treatment->laboratory_type_id)
                                ->get();
                                $checklist_detail = [];
                                foreach($laboratory_type_detail as $detail) {
                                    array_push($checklist_detail, [
                                        'id' => $detail->id,
                                        'name' => $detail->name,
                                    ]);
                                }
                                array_push($checklist, [
                                    'id' => $laboratory_type->id,
                                    'name' => $laboratory_type->name,
                                    'detail' => $checklist_detail
                                ]);
                           }

                           $checklist = json_encode($checklist);
                           $laboratory_id = DB::table('pivot_medical_records')
                            ->insertGetId([
                                'medical_record_id' => $medicalRecordDetail->medical_record_id,
                                'registration_detail_id' => $registration_detail_id,
                                'is_referenced' => 1,
                                'is_laboratory' => 1,
                                'medical_record_detail_id' => $medicalRecordDetail->id,
                                'additional' => '{"treatment":' . $checklist . '}'
                            ]);

                            DB::table('pivot_medical_records')
                            ->insert([
                                'medical_record_id' => $medicalRecordDetail->medical_record_id,
                                'registration_detail_id' => $registration_detail_id,
                                'is_referenced' => 1,
                                'is_laboratory_treatment' => 1,
                                'medical_record_detail_id' => $medicalRecordDetail->id,
                                'parent_id' => $laboratory_id
                            ]);


                    }
                }
        });
        
        static::deleted(function(MedicalRecordDetail $medicalRecordDetail){


                $cure = DB::table('medical_record_details')
                ->join('items', 'medical_record_details.item_id', 'items.id')
                ->join('pieces', 'pieces.id', 'items.piece_id')
                ->whereIsDrug(1)
                ->whereMedicalRecordId($medicalRecordDetail->medical_record_id)
                ->selectRaw("ARRAY_TO_STRING(ARRAY_AGG( CONCAT(items.name, ' sebanyak ', medical_record_details.qty, ' ', pieces.name) ), ', ') AS component")
                ->first();
                $medical_record = MedicalRecord::find($medicalRecordDetail->medical_record_id);
                $additional = $medical_record->additional;
                $additional->histopatologi_terapi = $cure->component;
                $medical_record->additional = $additional;
                $medical_record->save();
        });

        static::deleting(function(MedicalRecordDetail $medicalRecordDetail){
                DB::table('pivot_medical_records')
                ->whereMedicalRecordDetailId($medicalRecordDetail->id)
                ->whereIsReferenced(1)
                ->delete();
                if($medicalRecordDetail->is_bhp == 1) {

                    $stockTransaction = StockTransaction::create([
                            'date' => Carbon::now()->format('Y-m-d'),
                            'description' => 'Pembatalan penggunaan BHP pada pemeriksaan pasien',
                            'item_id' => $medicalRecordDetail->item_id,
                            'out_qty' => 0,
                            'in_qty' => $medicalRecordDetail->qty,
                            'lokasi_id' => $medicalRecordDetail->lokasi_id,
                        ]);
                }
        });

    }

    public function getAdditionalAttribute() {
        if(array_key_exists('additional', $this->attributes)) {
            $additional = json_decode($this->attributes['additional']);
            
            return $additional;
        }
        return json_decode('{}');
    }

    public function setAdditionalAttribute($value) {
        $json = $value;
        $additional = $this->additional;
        foreach($json as $key => $unit) {
            $additional->{$key} = $unit;
        } 
        $this->attributes['additional'] = json_encode($additional); 
    }

    public function setDiseaseIdAttribute($value) {
        if($value != null) {
            $is_number = preg_match('/^(\d+)$/', $value);
            if( $is_number ) {
                $this->attributes['disease_id'] = $value;
            } else {
                $disease = new Item();
                $disease->name = $value;
                $disease->code = date('ymHis') . Str::random(3);
                $disease->is_disease = 1;
                $disease->is_category = 0;
                $disease->save();
                $this->attributes['disease_id'] = $disease->id;
            }
        }
    }

    public function setSigna1Attribute($value) {
        if($value != null) {
            $is_number = preg_match('/^(\d+)$/', $value);
            if( $is_number ) {
                $this->attributes['signa1'] = $value;
            } else {
                $signa = new Permission();
                $signa->name = $value;
                $signa->slug = Str::random(4) . $value;
                $signa->description = 'signa1';
                $signa->is_signa = 1;
                $signa->save();
                $this->attributes['signa1'] = $signa->id;
            }
        }
    }

    public function setSigna2Attribute($value) {
        if($value != null) {
            $is_number = preg_match('/^(\d+)$/', $value);
            if( $is_number ) {
                $this->attributes['signa2'] = $value;
            } else {
                $signa = new Permission();
                $signa->name = $value;
                $signa->slug = Str::random(4) . $value;
                $signa->description = 'signa2';
                $signa->is_signa = 1;
                $signa->save();
                $this->attributes['signa2'] = $signa->id;
            }
        }
    }

    public function getFilenameAttribute() {
        if((array_key_exists('is_radiology', $this->attributes) || array_key_exists('is_laboratory', $this->attributes) || array_key_exists('is_pathology', $this->attributes) ) && array_key_exists('description', $this->attributes)) {

            if((array_key_exists('is_radiology', $this->attributes) && $this->attributes['is_radiology']  == 1) || (array_key_exists('is_laboratory', $this->attributes) && $this->attributes['is_laboratory']  == 1) || (array_key_exists('is_pathology', $this->attributes) && $this->attributes['is_pathology']  == 1) ) {
                return asset('/archive') . '/' . $this->attributes['description'];
            }
        }

        return null;
    }

    public function laboratory_pivot() {
        return $this->hasOne('App\PivotMedicalRecord', 'medical_record_detail_id', 'id')
        ->whereIsReferenced(1)
        ->whereIsLaboratory(1);
    }

    public function disease() {
        return $this->belongsTo('App\Item', 'disease_id', 'id')->whereIsDisease(1);
    }

    public function item() {
        return $this->belongsTo('App\Item');
    }

    public function lokasi() {
        return $this->belongsTo('App\Permission');
    }

    public function medical_record() {
        return $this->belongsTo('App\MedicalRecord');
    }

    public function disease_history() {
        return $this->whereIsDiseaseHistory(1);
    }

    public function diagnose_history() {
        return $this->whereIsDiagnoseHistory(1);
    }

    public function obgyn_disease_history() {
        return $this->whereIsObgynDiseaseHistory(1);
    }

    public function allergy_history() {
        return $this->whereIsAllergyHistory(1);
    }

    public function bhp() {
        return $this->whereIsBhp(1);
    }

    public function treatment_group() {
        return $this->whereIsTreatmentGroup(1);
    }

    public function sewa_ruangan() {
        return $this->whereIsSewaRuangan(1);
    }

    public function sewa_alkes() {
        return $this->whereIsSewaAlkes(1);
    }

    public function family_disease_history() {
        return $this->whereIsFamilyDiseaseHistory(1);
    }

    public function obgyn_family_disease_history() {
        return $this->whereIsObgynFamilyDiseaseHistory(1);
    }

    public function pain_history() {
        return $this->whereIsPainHistory(1);
    }

    public function kid_history() {
        return $this->whereIsKidHistory(1);
    }

    public function ginekologi_history() {
        return $this->whereIsGinekologiHistory(1);
    }

    public function pain_cure_history() {
        return $this->whereIsPainCureHistory(1);
    }

    public function imunisasi_history() {
        return $this->whereIsImunisasiHistory(1);
    }

    public function treatment() {
        return $this->whereIsTreatment(1);
    }

    public function diagnostic() {
        return $this->whereIsDiagnostic(1);
    }

    public function drug() {
        return $this->whereIsDrug(1);
    }

    public function kb_history() {
        return $this->whereIsKbHistory(1);
    }

    public function komplikasi_kb_history() {
        return $this->whereIsKomplikasiKbHistory(1);
    }
}
