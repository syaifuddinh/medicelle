<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ReceiptDetail extends Model
{
    public static function boot() {
        parent::boot(); 

        static::creating(function(Receipt $receipt) {   
            $purchase_order_detail = DB::table('purchase_order_details')
            ->whereId($receipt->purchase_order_id);

            $purchase_order_detail->increment('received_qty', $receipt->qty);
            $purchase_order_detail->decrement('leftover_qty', $receipt->qty);
        });
    }


    public function  setQtyAttribute($value) {
        if($value == null) {
            $value = 0;
        }
        $this->attributes['qty'] = $value;
    }

    public function setPurchasePriceAttribute($value) {
        if($value == null) {
            $value = 0;
        }
        $this->attributes['purchase_price'] = $value;
    }

    public function  setDiscountAttribute($value) {
        if($value == null) {
            $value = 0;
        }
        $this->attributes['discount'] = $value;
    }

    public function item() {
        return $this->belongsTo('App\Item');
    }

    public function purchase_order_detail() {
        return $this->belongsTo('App\PurchaseOrderDetail');
    }
}
