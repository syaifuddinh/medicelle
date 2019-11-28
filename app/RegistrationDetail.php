<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationDetail extends Model
{
    protected $fillable = ['registration_id', 'destination', 'polyclinic_id', 'time', 'doctor_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function doctor() {
        return $this->belongsTo('App\Contact', 'doctor_id', 'id')->whereIsDoctor(1);
    }

    public function polyclinic() {
        return $this->belongsTo('App\Polyclinic');
    }
}
