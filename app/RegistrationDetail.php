<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Registration;
use App\Contact;
use DB;

class RegistrationDetail extends Model
{
    protected $fillable = ['registration_id', 'destination', 'polyclinic_id', 'time', 'doctor_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public static function boot() {
        parent::boot();
        static::created(function(RegistrationDetail $registrationDetail) {
            DB::beginTransaction();
           

            // Generate medical record
            $registration = Registration::find($registrationDetail->registration_id);
            $medicalRecord = new MedicalRecord();
            $medicalRecord->fill($registration->toArray());
            $medicalRecord->registration_id = $registrationDetail->registration_id;
            $medicalRecord->registration_detail_id = $registrationDetail->id;
            $medicalRecord->save();

            $registration->medical_record_id = $medicalRecord->id;
            $registration->save();

            // Assign last medical record to patient
            $patient = Contact::find($registration->patient_id);
            $patient->medical_record_id = $medicalRecord->id;
            $patient->save();

            DB::commit();
        });


    }

    public function doctor() {
        return $this->belongsTo('App\Contact', 'doctor_id', 'id')->whereIsDoctor(1);
    }

    public function polyclinic() {
        return $this->belongsTo('App\Polyclinic');
    }
    public function registration() {
        return $this->belongsTo('App\Registration');
    }
}
