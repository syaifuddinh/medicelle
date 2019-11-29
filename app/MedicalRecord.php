<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class MedicalRecord extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['code', 'medical_record_id', 'patient_id', 'step', 'main_complaint'];
    public static function boot() {
        parent::boot();
        static::creating(function(MedicalRecord $medicalRecord) {
            $medicalRecord->date = date('Y-m-d');
            $medicalRecord->created_by = Auth::user()->id;
            // Generate medical record code
            $id = DB::table('medical_records')->count('id') + 1;
            $id = $id == null ? 1 : $id;
            $id = str_pad($id, 4, '0', STR_PAD_LEFT);
            $code = date('y.m.') . $id;

            $medicalRecord->code = $code; 
        });

        static::updating(function(MedicalRecord $medicalRecord) {
            $medicalRecord->updated_by = Auth::user()->id;
        });
    }
}
