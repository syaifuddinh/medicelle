<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class PurchaseOrderDetail extends Model
{
    
    protected $fillable = ['item_id', 'qty',  'purchase_price', 'discount', 'leftover_qty', 'received_qty'];

    protected $hidden = ['created_at', 'updated_at'];

    public static function boot() {
        parent::boot(); 


        static::updated(function(PurchaseOrderDetail $purchaseOrderDetail) {   
            $leftover = DB::table('purchase_order_details')
            ->wherePurchaseOrderId($purchaseOrderDetail->purchase_order_id)
            ->sum('leftover_qty') ?? 0;

            if($leftover == 0) {
                DB::table('purchase_orders')
                ->whereId($purchaseOrderDetail->purchase_order_id)
                ->update([
                    'is_receipt_completed' => 1
                ]);
            }
        });
    }

    public function  setQtyAttribute($value) {
        if($value == null) {
            $value = 0;
        }
        $this->attributes['qty'] = $value;
    }

    public function  setPurchasePriceAttribute($value) {
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
}
