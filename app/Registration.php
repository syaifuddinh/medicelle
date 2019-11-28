<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use App\MedicalRecord;

class Registration extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['assesment_id', 'medical_record_id', 'patient_id', 'patient_type', 'insurance_code', 'insurance_owner_name', 'plafon', 'family_type'];
    protected $appends = ['status_name'];

    public static function boot() {
        parent::boot();
        static::creating(function(Registration $registration) {
            $registration->date = date('Y-m-d');
            $registration->created_by = Auth::user()->id;
            $id = DB::table('registrations')->count('id') + 1;
            $id = $id == null ? 1 : $id;
            $id = str_pad($id, 5, '0', STR_PAD_LEFT);
            $code = 'RJ-' . date('ym') . $id;

            $registration->code = $code;
            // Generate medical record
            $medicalRecord = new MedicalRecord();
            $medicalRecord->fill($registration->toArray());
            $medicalRecord->save();
            $registration->medical_record_id = $medicalRecord->id;
        });

        static::updating(function(Registration $registration) {
            $registration->updated_by = Auth::user()->id;
        });

    }

    public function getStatusNameAttribute() {
        if(!array_key_exists('status', $this->attributes)) {
            return null;
        } else {
            if($this->attributes['status'] == 1) {
                return 'Terjadwal';
            } else if($this->attributes['status'] == 2) {
                return 'Hadir';
            } else if($this->attributes['status'] == 3) {
                return 'Batal';
            } else {
                return null;
            }
        }
    }

    public function detail() {
        return $this->hasMany('App\RegistrationDetail');
    }
    public function medical_record() {
        return $this->belongsTo('App\MedicalRecord');
    }
    public function patient() {
        return $this->belongsTo('App\Contact', 'patient_id', 'id')->whereIsPatient(1);
    }
    public function pic() {
        return $this->belongsTo('App\Contact', 'pic_id', 'id')->whereIsFamily(1)->orWhere('is_agency', 1);
    }
}
