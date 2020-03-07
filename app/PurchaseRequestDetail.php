<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;

class PurchaseRequestDetail extends Model
{
    protected $fillable = ['item_id', 'supplier_id', 'qty', 'discount', 'purchase_price'];

    protected $hidden = ['created_at', 'updated_at'];

    public static function boot() {
        parent::boot(); 

        static::creating(function(PurchaseRequestDetail $purchaseRequestDetail) {   
            $latestItem = PurchaseRequestDetail::whereItemId($purchaseRequestDetail->item_id)
            ->whereSupplierId($purchaseRequestDetail->supplier_id)
            ->wherePurchaseRequestId($purchaseRequestDetail->purchase_request_id)
            ->count('id');

            if($latestItem > 0) {
                $item = DB::table('items')
                ->whereId($purchaseRequestDetail->item_id)
                ->first();
                $supplier = DB::table('contacts')
                ->whereId($purchaseRequestDetail->supplier_id)
                ->first();
                throw new Exception( $item->name . " dengan supplier " . $supplier->name . " sudah diinputkan sekali" );
            }

            if($purchaseRequestDetail->qty < 1) {
                throw new Exception( "Jumlah permintaan tidak boleh kosong" );                
            }

            $item = DB::table('items')
            ->whereId($purchaseRequestDetail->item_id)
            ->first();

            if($item->minimal_stock > $item->current_stock + $purchaseRequestDetail->qty) {
                throw new Exception( "Minimal stok dari " . $item->name . " adalah " . $item->minimal_stock);                                
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

    public function supplier() {
        return $this->belongsTo('App\Contact');
    }
}
