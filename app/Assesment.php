<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Assesment extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['step', 'date', 'registration_id', 'patient_id', 'created_by', 'updated_by'];

    public static function boot() {
        parent::boot();

        static::creating(function(Assesment $assesment){
            $assesment->date = date('Y-m-d');
            $assesment->created_by = Auth::user()->id;
        });

        static::updating(function(Assesment $assesment){
            $assesment->updated_by = Auth::user()->id;
        });
    }
}
