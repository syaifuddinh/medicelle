<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StockTransaction;
use Carbon\Carbon;
use DB;

class ReceiptDetail extends Model
{
    protected $fillable = ['item_id', 'qty',  'purchase_price', 'discount', 'purchase_order_detail_id'];

    public static function boot() {
        parent::boot(); 

        static::created(function(ReceiptDetail $receiptDetail) {   
            // Update harga beli pada master item
            DB::table('items')
            ->whereId($receiptDetail->item_id)
            ->update([
                'purchase_price' => $receiptDetail->purchase_price
            ]);

            $purchase_order_detail = DB::table('purchase_order_details')
            ->whereId($receiptDetail->purchase_order_detail_id);
            $purchase_order_detail->increment('received_qty');
            $purchase_order_detail->decrement('leftover_qty');

            $receipt = DB::table('receipts')
            ->whereId($receiptDetail->receipt_id)
            ->select('supplier_id')
            ->first();
            $gudang_farmasi = DB::table('permissions')
            ->whereIsLokasi(1)
            ->whereIsGudangFarmasi(1)
            ->select('id')
            ->first();

            $stockTransaction = StockTransaction::create([
                'date' => Carbon::now()->format('Y-m-d'),
                'description' => 'Penerimaan Barang',
                'item_id' => $receiptDetail->item_id,
                'supplier_id' => $receipt->supplier_id,
                'in_qty' => $receiptDetail->qty,
                'lokasi_id' => $gudang_farmasi->id,
                'receipt_detail_id' => $receiptDetail->id
            ]);
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