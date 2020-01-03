<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PivotMedicalRecord extends Model
{
    protected $fillable = ['medical_record_id'];

    public function registration_detail() {
        return $this->belongsTo('App\RegistrationDetail', 'registration_detail_id', 'id');
    }

    public function medical_record() {
        return $this->belongsTo('App\MedicalRecord');
    }
}
