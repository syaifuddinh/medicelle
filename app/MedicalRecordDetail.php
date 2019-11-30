<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalRecordDetail extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['medical_record_id', 'disease_id', 'cure', 'last_checkup_date', 'pain_type', 'is_other_pain_type', 'pain_location', 'pain_duration', 'emergence_time', 'side_effect', 'is_allergy_history', 'is_disease_history', 'is_family_disease_history', 'is_pain_history', 'is_pain_cure_history', 'is_unknown'];

    public function disease() {
        return $this->belongsTo('App\Item', 'disease_id', 'id')->whereIsDisease(1);
    }

    public function disease_history() {
        return $this->whereIsDiseaseHistory(1);
    }

    public function family_disease_history() {
        return $this->whereIsFamilyDiseaseHistory(1);
    }

    public function pain_history() {
        return $this->whereIsPainHistory(1);
    }

    public function pain_cure_history() {
        return $this->whereIsPainCureHistory(1);
    }
}
