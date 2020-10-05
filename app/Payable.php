<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payable extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['contact_id', 'price', 'qty', 'discount', 'is_paid', 'receipt_detail_id', 'date'];

    public static function boot() {
        parent::boot(); 

        static::creating(function(Payable $payable) {   
            $payable->discount_value = $payable->price * $payable->discount / 100;
            $payable->total_price = $payable->price * $payable->qty;
            $payable->total_discount_value = $payable->total_price * $payable->discount / 100;
            $payable->grandtotal = $payable->total_price - $payable->total_discount_value;
        });
    }

    public function contact() {
        return $this->belongsTo('App\Contact');
    }
    public function receipt_detail() {
        return $this->belongsTo('App\ReceiptDetail');
    }
}
