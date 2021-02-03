<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MedicalRecordDetail;
use DB;
use Exception;

class AssesmentDetail extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['assesment_id', 'disease_id', 'cure', 'last_checkup_date', 'pain_type', 'is_other_pain_type', 'pain_location', 'pain_duration', 'emergence_time', 'side_effect', 'is_allergy_history', 'is_disease_history', 'is_family_disease_history', 'is_pain_history', 'is_pain_cure_history', 'is_unknown', 'is_kid_history','is_pregnant_week_age','kid_order','partus_year','partus_location','pregnant_month_age','pregnant_week_age','birth_type','birth_helper','birth_obstacle','weight','long','komplikasi_nifas', 'baby_gender', 'is_imunisasi_history','is_other_imunisasi','is_imunisasi_month_age','imunisasi_month_age','imunisasi_year_age','imunisasi','reaksi_imunisasi'];

    public static function boot() {
        parent::boot();

        static::created(function(AssesmentDetail $assesmentDetail) {
            $assesment = DB::table('assesments')
            ->whereId($assesmentDetail->assesment_id)
            ->first();
            $registrationDetails = DB::table('registration_details')
            ->join('pivot_medical_records', 'pivot_medical_records.registration_detail_id', 'registration_details.id')
            ->where('registration_details.registration_id', $assesment->registration_id)
            ->select('pivot_medical_records.medical_record_id')
            ->groupBy('pivot_medical_records.medical_record_id')
            ->get();

            $disease_name = '';
            if($assesmentDetail->disease_id) {
                $item = DB::table('items')
                ->whereId($assesmentDetail->disease_id)
                ->select('name')
                ->first();
                if($item !== null) {
                    $disease_name = $item->name;
                }
            }

            foreach ($registrationDetails as $r) {
                if($assesmentDetail->is_disease_history == 1) {
                    $medicalRecordDetail = new MedicalRecordDetail();
                    $medicalRecordDetail->medical_record_id = $r->medical_record_id;
                    $medicalRecordDetail->is_disease_history = 1;
                    $medicalRecordDetail->disease_name = $assesmentDetail->imunisasi;
                    $medicalRecordDetail->cure = $assesmentDetail->cure;
                    $medicalRecordDetail->description = $assesmentDetail->side_effect; //pake side_effect utk menyimpan textbased terakhir kontrol
                    $medicalRecordDetail->assesment_detail_id = $assesmentDetail->id;
                    $medicalRecordDetail->save();

                    $medicalRecordDetail = new MedicalRecordDetail();
                    $medicalRecordDetail->medical_record_id = $r->medical_record_id;
                    $medicalRecordDetail->is_obgyn_disease_history = 1;
                    $medicalRecordDetail->disease_name = $assesmentDetail->imunisasi;
                    $medicalRecordDetail->cure = $assesmentDetail->cure;
                    $medicalRecordDetail->description = $assesmentDetail->side_effect; //pake side_effect utk menyimpan textbased terakhir kontrol
                    $medicalRecordDetail->assesment_detail_id = $assesmentDetail->id;
                    $medicalRecordDetail->save();
                }    
                if($assesmentDetail->is_family_disease_history == 1) {
                    $medicalRecordDetail = new MedicalRecordDetail();
                    $medicalRecordDetail->medical_record_id = $r->medical_record_id;
                    $medicalRecordDetail->disease_name = $assesmentDetail->imunisasi;
                    $medicalRecordDetail->is_family_disease_history = 1;
                    $medicalRecordDetail->cure = $assesmentDetail->cure;//cure disini adalah keluarga yg menderita penyakit
                    $medicalRecordDetail->description = $assesmentDetail->side_effect;//side effect disini adalah status dari isian tsb
                    //$medicalRecordDetail->description = 'Obat yang pernah diminum adalah ' . $assesmentDetail->cure . '. Tanggal kontrol terakhir adalah ' . $assesmentDetail->last_checkup_date;
                    $medicalRecordDetail->assesment_detail_id = $assesmentDetail->id;
                    $medicalRecordDetail->save();

                    $medicalRecordDetail = new MedicalRecordDetail();
                    $medicalRecordDetail->medical_record_id = $r->medical_record_id;
                    $medicalRecordDetail->is_obgyn_family_disease_history = 1;
                    $medicalRecordDetail->disease_name = $assesmentDetail->imunisasi;
                    $medicalRecordDetail->cure = $assesmentDetail->cure;
                    $medicalRecordDetail->description = $assesmentDetail->side_effect;//side effect disini adalah status dari isian tsb
                    $medicalRecordDetail->assesment_detail_id = $assesmentDetail->id;
                    $medicalRecordDetail->save();
                }    

                if($assesmentDetail->is_allergy_history == 1) {
                    $medicalRecordDetail = new MedicalRecordDetail();
                    $medicalRecordDetail->medical_record_id = $r->medical_record_id;
                    $medicalRecordDetail->cure = $assesmentDetail->cure;
                    $medicalRecordDetail->side_effect = $assesmentDetail->side_effect;
                    $medicalRecordDetail->is_allergy_history = 1;
                    $medicalRecordDetail->assesment_detail_id = $assesmentDetail->id;
                    $medicalRecordDetail->save();
                }    
            }

        });
        
        static::deleted(function(AssesmentDetail $assesmentDetail){
            throw new Exception($assesmentDetail->id);
            MedicalRecordDetail::whereAssesmentDetailId($assesmentDetail->id)->delete();
        });

    }
    
    public function disease() {
        return $this->belongsTo('App\Item', 'disease_id', 'id')->whereIsDisease(1);
    }

    public function disease_history() {
        return $this->whereIsDiseaseHistory(1);
    }

    public function allergy_history() {
        return $this->whereIsAllergyHistory(1);
    }

    public function family_disease_history() {
        return $this->whereIsFamilyDiseaseHistory(1);
    }

    public function pain_history() {
        return $this->whereIsPainHistory(1);
    }

    public function kid_history() {
        return $this->whereIsKidHistory(1);
    }

    public function pain_cure_history() {
        return $this->whereIsPainCureHistory(1);
    }

    public function imunisasi_history() {
        return $this->whereIsImunisasiHistory(1);
    }
}
