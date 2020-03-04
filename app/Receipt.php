<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class Receipt extends Model
{
    protected $fillable = ['date', 'date_start', 'date_end', 'description', 'purchase_order_id', 'supplier_id'];

    protected $hidden = ['created_at', 'updated_at'];


    public static function boot() {
        parent::boot(); 

        static::creating(function(Receipt $receipt) {   
            $receipt->created_by = Auth::user()->id;

            $current_month = date('m');
            $current_year = date('Y');
            $id = Receipt::whereRaw("TO_CHAR(date::DATE, 'mm') = '$current_month' AND TO_CHAR(date::DATE, 'YYYY') = '$current_year'")
            ->count('id') + 1;
            $id = $id == null ? 1 : $id;
            $id = str_pad($id, 5, '0', STR_PAD_LEFT);
            $code = 'TF-' . date('ym') . '-' .  $id;

            $receipt->code = $code;

            $po = DB::table('purchase_orders')
            ->whereId($receipt->purchase_order_id)
            ->update([
                'is_used' => 1
            ]);
        });
    }

    public function detail() {
        return $this->hasMany('App\ReceiptDetail');
    }

    public function purchase_order() {
        return $this->belongsTo('App\PurchaseOrder');
    }
    
    public function supplier() {
        return $this->belongsTo('App\Contact');
    }
}
