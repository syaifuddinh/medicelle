<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssesmentDetail extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['assesment_id', 'disease_id', 'cure', 'last_checkup_date', 'pain_type', 'is_other_pain_type', 'pain_location', 'pain_duration', 'emergence_time', 'side_effect', 'is_allergy_history', 'is_disease_history', 'is_family_disease_history', 'is_pain_history', 'is_pain_cure_history', 'is_unknown', 'is_kid_history','is_pregnant_week_age','kid_order','partus_year','partus_location','pregnant_month_age','pregnant_week_age','birth_type','birth_helper','birth_obstacle','weight','long','komplikasi_nifas', 'baby_gender', 'is_imunisasi_history','is_other_imunisasi','is_imunisasi_month_age','imunisasi_month_age','imunisasi_year_age','imunisasi','reaksi_imunisasi'];

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
