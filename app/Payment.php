<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['debet', 'credit', 'date', 'contact_id', 'description', 'is_discount_off'];

    public static function boot() {
        parent::boot(); 

        static::creating(function(Payment $payment) {   
            $payment->created_by = auth()->user()->id;
            $payment->leftover = $payment->debet - $payment->credit;
        });
        static::updating(function(Payment $payment) {   
            $payment->leftover = $payment->debet - $payment->credit;
        });
    }

    public function detail() {
        return $this->belongsTo('App\PaymentDetail');
    }

    public function contact() {
        return $this->belongsTo('App\Contact');
    }

    public function created_by() {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
}
