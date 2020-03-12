<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Invoice;
use App\RegistrationDetail;
use App\StockTransaction;
use DB;
use Carbon\Carbon;
use Exception;
use Auth;

class Formula extends Model
{
    protected $fillable = ['date', 'medical_record_id', 'registration_detail_id', 'is_approve', 'invoice_id'];
    protected $hidden = ['created_at', 'updated_at'];


    public static function boot() {
        parent::boot(); 

        static::creating(function(Formula $formula) {
            $formula->updated_by = Auth::user()->id;
        });

        static::updating(function(Formula $formula) {
            $formula->updated_by = Auth::user()->id;
            if($formula->is_approve == 1) {
                if($formula->invoice_id == null) {
                    $invoice = new Invoice();
                    $invoice->is_nota_pemeriksaan = 1;
                    $invoice->payment_method = 'TUNAI';
                    $registration_detail = RegistrationDetail::with('registration:id,patient_id','registration.patient:id,name,patient_type')->find($formula->registration_detail_id);
                    $registration = $registration_detail->registration;
                    if($registration->patient_type == 'ASURANSI SWASTA') {
                        $invoice->payment_type = 'ASURANSI SWASTA';                        
                    } else {
                        $invoice->payment_type = 'BAYAR SENDIRI';                        
                    };
                    $invoice->registration_id = $registration->id;
                    $invoice->save();
                    $formulaUnit = Formula::find($formula->id);
                    $details = $formulaUnit->detail;
                    foreach($details as $detail) {
                        $item = DB::table('items')
                        ->whereId($detail->item_id)
                        ->first();
                        $invoice->child()->create([
                            'is_item' => 1,
                            'item_id' => $detail->item_id,
                            'qty' => $detail->qty,
                            'debet' => $item->price
                        ]);

                        $stock = DB::table('stocks')
                        ->whereId($detail->stock_id)
                        ->first();
                        // throw new Exception($detail->qty);
                        $stockTransaction = StockTransaction::create([
                            'date' => Carbon::now()->format('Y-m-d'),
                            'description' => 'Penggunaan Resep Obat',
                            'item_id' => $detail->item_id,
                            'in_qty' => 0,
                            'out_qty' => $detail->qty,
                            'lokasi_id' => $detail->lokasi_id,
                            'expired_date' => $stock->expired_date
                        ]);

                        DB::table('formula_details')
                        ->whereId($detail->id)
                        ->update([
                            'stock_transaction_id' => $stockTransaction->id
                        ]);
                    }
                    $formula->invoice_id = $invoice->id;
                }
            }
        });
    }


    public function contributor() {
        return $this->belongsTo('App\User', 'updated_by', 'id');
    }

    public function medical_record() {
        return $this->belongsTo('App\MedicalRecord');
    }

    public function registration_detail() {
        return $this->belongsTo('App\RegistrationDetail');
    }

    public function invoice() {
        return $this->belongsTo('App\Invoice');
    }

    public function detail() {
        return $this->hasMany('App\FormulaDetail');
    }
}
