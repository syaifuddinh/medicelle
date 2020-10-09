<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Payment;
use Exception;
use DB;

class PaymentDetail extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['payment_id', 'receipt_detail_id', 'debet', 'credit'];

    public static function boot() {
        parent::boot();

        static::creating(function(PaymentDetail $paymentDetail) {
            $payment = Payment::find($paymentDetail->payment_id);
            $payment->increment('debet', $paymentDetail->debet);
            $payment->increment('credit', $paymentDetail->credit);
            $payment->save();
        });

        static::updated(function(PaymentDetail $paymentDetail) {
           $debet = DB::table('payment_details')
           ->wherePaymentId($paymentDetail->payment_id)
           ->sum('debet');
           $credit = DB::table('payment_details')
           ->wherePaymentId($paymentDetail->payment_id)
           ->sum('credit');

           $payment = Payment::find($paymentDetail->payment_id);
           $payment->debet = $debet;
           $payment->credit = $credit;
           $payment->save();
        });

    }
}
