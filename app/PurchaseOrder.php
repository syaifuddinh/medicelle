<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class PurchaseOrder extends Model
{
    protected $fillable = ['date', 'date_start', 'date_end', 'description', 'purchase_request_id', 'supplier_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public static function boot() {
        parent::boot(); 

        static::creating(function(PurchaseOrder $purchaseOrder) {   
            $purchaseOrder->created_by = Auth::user()->id;

            $current_month = date('m');
            $current_year = date('Y');
            $id = PurchaseOrder::whereRaw("TO_CHAR(date::DATE, 'mm') = '$current_month' AND TO_CHAR(date::DATE, 'YYYY') = '$current_year'")
            ->count('id') + 1;
            $id = $id == null ? 1 : $id;
            $id = str_pad($id, 5, '0', STR_PAD_LEFT);
            $code = 'PO-' . date('ym') . '-' .  $id;

            $purchaseOrder->code = $code;
        });
    }

    public function detail() {
        return $this->hasMany('App\PurchaseOrderDetail');
    }

    public function purchase_request() {
        return $this->belongsTo('App\PurchaseRequest');
    }
    
    public function supplier() {
        return $this->belongsTo('App\Contact');
    }
}
