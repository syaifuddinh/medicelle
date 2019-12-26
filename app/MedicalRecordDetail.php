<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;
use Str;


class MedicalRecordDetail extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['medical_record_id', 'disease_id', 'disease_name', 'name', 'duration', 'cure', 'last_checkup_date', 'pain_type', 'is_other_pain_type', 'pain_location', 'pain_duration', 'emergence_time', 'side_effect', 'is_allergy_history', 'is_disease_history', 'is_family_disease_history', 'is_pain_history', 'is_pain_cure_history', 'is_unknown', 'is_kid_history','is_pregnant_week_age','kid_order','partus_year','partus_location','pregnant_month_age','pregnant_week_age','birth_type','birth_helper','birth_obstacle','weight','long','komplikasi_nifas', 'baby_gender', 'is_imunisasi_history','is_other_imunisasi','is_imunisasi_month_age','imunisasi_month_age','imunisasi_year_age','imunisasi','reaksi_imunisasi', 'is_ginekologi_history', 'is_other_ginekologi', 'is_obgyn_disease_history', 'is_obgyn_family_disease_history', 'is_kb_history', 'is_komplikasi_kb_history', 'is_diagnose_history', 'type', 'description', 'is_other', 'is_drug', 'is_treatment', 'is_diagnostic', 'item_id', 'qty', 'reduksi', 'date', 'result_date', 'signa1', 'signa2', 'lokasi_id', 'kanan', 'kiri', 'kesimpulan', 'saran'
    ];
    protected $appends = ['filename'];

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

    public function getFilenameAttribute() {
        if((array_key_exists('is_radiology', $this->attributes) || array_key_exists('is_laboratory', $this->attributes) || array_key_exists('is_pathology', $this->attributes) ) && array_key_exists('description', $this->attributes)) {

            if((array_key_exists('is_radiology', $this->attributes) && $this->attributes['is_radiology']  == 1) || (array_key_exists('is_laboratory', $this->attributes) && $this->attributes['is_laboratory']  == 1) || (array_key_exists('is_pathology', $this->attributes) && $this->attributes['is_pathology']  == 1) ) {
                return asset('/archive') . '/' . $this->attributes['description'];
            }
        }

        return null;
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
