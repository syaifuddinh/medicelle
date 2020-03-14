<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PivotMedicalRecord extends Model
{
    protected $fillable = ['medical_record_id', 'additional'];

    public function getAdditionalAttribute() {
        if(array_key_exists('additional', $this->attributes)) {
            $additional = json_decode($this->attributes['additional']);
            return $additional;
        }
        return json_decode('{}');
    }


    public function registration_detail() {
        return $this->belongsTo('App\RegistrationDetail', 'registration_detail_id', 'id');
    }

    public function medical_record() {
        return $this->belongsTo('App\MedicalRecord');
    }

    public function medical_record_detail() {
        return $this->belongsTo('App\MedicalRecordDetail');
    }

    public function parent() {
        return $this->belongsTo('App\PivotMedicalRecord', 'parent_id', 'id');
    }
}
