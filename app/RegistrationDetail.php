<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Formula;
use App\Registration;
use App\Contact;
use App\Invoice;
use App\InvoiceDetail;
use App\PivotMedicalRecord;
use Carbon\Carbon;
use DB;
use Exception;
use Auth;

class RegistrationDetail extends Model
{
    protected $fillable = ['registration_id', 'destination', 'polyclinic_id', 'time', 'doctor_id', 'medical_record_refer_id', 'status'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['status_name', 'visiting_room'];

    public function getStatusNameAttribute() {
        if(!array_key_exists('status', $this->attributes)) {
            return null;
        } else {
            if($this->attributes['status'] == 1) {
                return 'Sudah diperiksa';
            } else if($this->attributes['status'] == 0) {
                return 'Belum diperiksa';
            } else {
                return null;
            }
        }
    }


    public function getVisitingRoomAttribute() {
        if(array_key_exists('destination', $this->attributes)) {
        
            if($this->attributes['destination'] == 'POLIKLINIK' && array_key_exists('polyclinic_id', $this->attributes)) {
                return 'Poliklinik ' . $this->polyclinic->name;
            } else {
                return $this->attributes['destination'];
            }
        }

        return null;
    }

    public static function registered_polyclinic() {
        $self = self::whereDestination('POLIKLINIK');
        $user = Auth::user();
        if($user->is_admin != 1) {
            if($user->doctor) {
                return $self->whereDoctorId($user->contact_id);
            } 
        }

        return $self;
    }

    public static function registered_laboratory() {
        $self = self::whereDestination('LABORATORIUM');
        $user = Auth::user();
        if($user->is_admin != 1) {
            if($user->doctor) {
                return $self->whereDoctorId($user->contact_id);
            } 
        }

        return $self;
    }


    public static function registered_ruang_tindakan() {
        $self = self::whereDestination('RUANG TINDAKAN');
        $user = Auth::user();
        if($user->is_admin != 1) {
            if($user->doctor) {
                return $self->whereDoctorId($user->contact_id);
            } 
        }

        return $self;
    }

    public static function registered_medical_checkup() {
        $self = self::whereDestination('MEDICAL CHECK-UP');
        $user = Auth::user();
        if($user->is_admin != 1) {
            if($user->doctor) {
                return $self->whereDoctorId($user->contact_id);
            } 
        }

        return $self;
    }


    public static function registered_radiology() {
        $self = self::whereDestination('RADIOLOGI');
        $user = Auth::user();
        if($user->is_admin != 1) {
            if($user->doctor) {
                return $self->whereDoctorId($user->contact_id);
            } 
        }

        return $self;
    }


    public static function registered_chemoterapy() {
        $self = self::whereDestination('KEMOTERAPI');
        $user = Auth::user();
        if($user->is_admin != 1) {
            if($user->doctor) {
                return $self->whereDoctorId($user->contact_id);
            } 
        }

        return $self;
    }

    public function doctor() {
        return $this->belongsTo('App\Contact', 'doctor_id', 'id')->whereIsDoctor(1);
    }

    public function medical_record() {
        return $this->hasOne('App\MedicalRecord',  'registration_detail_id', 'id');
    }

    public function pivot_medical_record() {
        return $this->hasMany('App\PivotMedicalRecord', 'registration_detail_id', 'id');
    }
    public function medical_record_refer() {
        return $this->belongsTo('App\MedicalRecord',  'medical_record_refer_id', 'id');
    }

    public function polyclinic() {
        return $this->belongsTo('App\Polyclinic');
    }
    public function registration() {
        return $this->belongsTo('App\Registration');
    }

    public static function amademenConsultationInvoice($id) {
        $dt = self::whereId($registration_detail_id);
        $invoice = Invoice::whereRegistrationId($dt->registration_id)        
        ->whereIsNotaRawatJalan(1)
        ->first();
        if($invoice) {
            $medicalRecord = DB::table('medical_records')
            ->whereRegistrationDetailId($id)
            ->first();

            $reduksi = $medicalRecord->reduksi ?? 0;
            $invoice = Invoice::find($invoice->id);
            $invoice->reduksi = $reduksi;
            $invoice->save();
        }
    }
}
