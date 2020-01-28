<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Registration;
use App\Contact;
use App\Invoice;
use App\InvoiceDetail;
use App\PivotMedicalRecord;
use DB;
use Auth;

class RegistrationDetail extends Model
{
    protected $fillable = ['registration_id', 'destination', 'polyclinic_id', 'time', 'doctor_id', 'medical_record_refer_id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['status_name', 'visiting_room'];

    public static function boot() {
        parent::boot();

        static::updating(function(RegistrationDetail $registrationDetail) {
            if($registrationDetail->status == 1) {
                PivotMedicalRecord::where('registration_detail_id', '!=', $registrationDetail->id)->whereMedicalRecordId($registrationDetail->medical_record->id)->delete();
                $latestInvoice = Invoice::whereRegistrationId($registrationDetail->registration_id)->whereIsNotaPengobatan(1)->first();
                if($latestInvoice == null) {
                    $registration = $registrationDetail->registration;
                    $invoice = new Invoice();
                    $invoice->is_nota_pengobatan = 1;
                    $invoice->payment_method = 'TUNAI';
                    if($registration->patient_type == 'ASURANSI SWASTA') {
                        $invoice->payment_type = 'ASURANSI SWASTA';                        
                    } else {
                        $invoice->payment_type = 'BAYAR SENDIRI';                        
                    }
                    $invoice->registration_id = $registration->id;
                    $invoice->save();
                } else {
                    $invoice = Invoice::find($latestInvoice->id);
                }
                $medicalRecord = $registrationDetail->medical_record;
                $treatments = $medicalRecord->treatment;
                $diagnostics = $medicalRecord->diagnostic;
                $bhp = $medicalRecord->bhp;
                $sewa_ruangan = $medicalRecord->sewa_ruangan;
                $sewa_alkes = $medicalRecord->sewa_alkes;
                DB::beginTransaction();
                foreach($treatments as $value) {
                    InvoiceDetail::create([
                        'invoice_id' => $invoice->id,
                        'item_id' => $value->item_id,
                        'qty' => $value->qty,
                        'is_item' => 1,
                        'is_profit_sharing' => 1,
                        'debet' => $value->item->price,
                        'reduksi' => $value->reduksi
                    ]);
                }
                foreach($diagnostics as $value) {
                    InvoiceDetail::create([
                        'invoice_id' => $invoice->id,
                        'item_id' => $value->item_id,
                        'is_profit_sharing' => 1,
                        'qty' => $value->qty,
                        'is_item' => 1,
                        'debet' => $value->item->price,
                        'reduksi' => $value->reduksi
                    ]);
                }
                foreach($bhp as $value) {
                    InvoiceDetail::create([
                        'invoice_id' => $invoice->id,
                        'item_id' => $value->item_id,
                        'qty' => $value->qty,
                        'is_item' => 1,
                        'debet' => $value->item->price,
                    ]);
                }
                foreach($sewa_ruangan as $value) {
                    InvoiceDetail::create([
                        'invoice_id' => $invoice->id,
                        'item_id' => $value->item_id,
                        'qty' => $value->qty,
                        'is_item' => 1,
                        'debet' => $value->item->price,
                    ]);
                }
                foreach($sewa_alkes as $value) {
                    InvoiceDetail::create([
                        'invoice_id' => $invoice->id,
                        'item_id' => $value->item_id,
                        'qty' => $value->qty,
                        'is_item' => 1,
                        'debet' => $value->item->price,
                    ]);
                }
                DB::commit();

            }
        });

    }

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
}
