<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use App\MedicalRecord;
use App\Assesment;
use App\Contact;
use App\Invoice;
use App\InvoiceDetail;
use App\Price;
use App\RegistrationDetail;

class Registration extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['assesment_id', 'medical_record_id', 'patient_id', 'patient_type', 'insurance_code', 'insurance_owner_name', 'plafon', 'family_type', 'date'];
    protected $appends = ['status_name'];

    public static function boot() {
        parent::boot();
        static::creating(function(Registration $registration) {
            DB::beginTransaction();
            $registration->created_by = Auth::user()->id;
            $current_month = date('m');
            $current_year = date('Y');
            $id = DB::table('registrations')
            ->whereRaw("TO_CHAR(date::DATE, 'mm') = '$current_month' AND TO_CHAR(date::DATE, 'YYYY') = '$current_year'")
            ->count('id') + 1;
            $id = $id == null ? 1 : $id;
            $id = str_pad($id, 5, '0', STR_PAD_LEFT);
            $code = 'RJ-' . date('ym') . $id;

            $registration->code = $code;
            // Validasi tanggal
            $date = $registration->date;
            if(preg_match('/19\d{2}-\d+-\d+/', $date)) {
                $date = preg_replace('/19(\d{2}-\d+-\d+)/', '20$1', $date);
                $registration->date = $date;
            }
            DB::commit();
        });

        static::created(function(Registration $registration) {
            // Generate assesment
            $assesment = new Assesment();
            $assesment->patient_id = $registration->patient_id;
            $assesment->registration_id = $registration->id;
            $assesment->save();
        });

        static::updating(function(Registration $registration) {
            $registration->updated_by = Auth::user()->id;
            if($registration->status == 2) {
                DB::beginTransaction();
                $invoice = Invoice::whereRegistrationId($registration->id)->first();
                if($invoice == null) {
                    DB::beginTransaction();
                    $latestInvoice = Invoice::whereRegistrationId($registration->id)->select('id')->first();
                    if($latestInvoice == null) {
                        $invoice = new Invoice();
                        $invoice->is_nota_rawat_jalan = 1;
                        $invoice->payment_method = 'TUNAI';
                        if($registration->patient_type == 'ASURANSI SWASTA') {
                            $invoice->payment_type = 'ASURANSI SWASTA';                        
                        } else {
                            $invoice->payment_type = 'BAYAR SENDIRI';                        
                        }
                        $invoice->registration_id = $registration->id;
                        $invoice->save();
                        $invoice_id = $invoice->id;

                        $registrationItem = Price::whereIsRegistration(1)
                        ->whereRaw("destination IN (SELECT destination FROM registration_details WHERE registration_id = " . $registration->id . ")")
                        ->whereIsActive(1)
                        ->get()
                        ->toArray();
                        collect($registrationItem)->each(function($val) use($invoice_id){
                            $invoiceDetail = new InvoiceDetail();
                            $invoiceDetail->invoice_id = $invoice_id; 
                            $invoiceDetail->item_id = $val['item_id']; 
                            $invoiceDetail->is_item = 1; 
                            $invoiceDetail->qty = $val['qty']; 
                            $invoiceDetail->debet = $val['custom_price']; 
                            $invoiceDetail->save();
                        });
                    }

                    // $registrationDetail = RegistrationDetail::whereRegistrationId($registration->id)->get()->toArray();
                    // collect($registrationDetail)->each(function($val) use($invoice_id){
                    //     $price = Price::whereIsRegistration(0)
                    //     ->whereDestination($val['destination'])
                    //     ->wherePolyclinicId($val['polyclinic_id'])
                    //     ->get()
                    //     ->toArray();

                    //     collect($price)->each(function($val) use($invoice_id){
                    //         $invoiceDetail = new InvoiceDetail();
                    //         $invoiceDetail->invoice_id = $invoice_id; 
                    //         $invoiceDetail->item_id = $val['item_id']; 
                    //         $invoiceDetail->is_item = 1; 
                    //         $invoiceDetail->qty = $val['qty']; 
                    //         $invoiceDetail->debet = $val['custom_price']; 
                    //         $invoiceDetail->save();
                    //     });
                    // });



                    DB::commit();
                }

                $r = Registration::find($registration->id);
                if(count($r->medical_record_item) == 0) {
                    $detail = $r->detail;
                    foreach ($detail as $x) {
                        $medicalRecordDetail = $x->medical_record();
                        $fill = $registration->toArray();
                        $fill['registration_id'] = $registration->id;
                        $m = $medicalRecordDetail->create($fill);
                        $r->medical_record_id = $m->id;   
                        $x->pivot_medical_record()->create([
                            'medical_record_id' => $m->id
                        ]);
                    }
                    $r->save();
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

    public function medical_record_item() {
        return $this->hasMany('App\MedicalRecord');
    }
    public function assesment() {
        return $this->hasOne('App\Assesment', 'registration_id', 'id');
    }
    public function polyclinic_registered() {
        $outp = $this->hasOne('App\RegistrationDetail', 'registration_id', 'id')->whereDestination('POLIKLINIK');
        $user = Auth::user();
        if($user->is_admin != 1) {
            if($user->doctor) {
                return $outp->whereDoctorId($user->contact_id);
            } 
        }

        return $outp;
    }

    

    public function invoice() {
        return $this->hasOne('App\Invoice', 'registration_id', 'id');
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
