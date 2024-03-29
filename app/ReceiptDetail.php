<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StockTransaction;
use App\Item;
use App\Payable;
use App\PurchaseOrderDetail;
use Carbon\Carbon;
use DB;
use Exception;

class ReceiptDetail extends Model
{
    protected $fillable = ['item_id', 'qty',  'purchase_price', 'discount', 'post_discount', 'purchase_order_detail_id', 'expired_date', 'hna'];
    protected $appends = ['subtotal'];

    public static function boot() {
        parent::boot(); 

        static::creating(function(ReceiptDetail $receiptDetail) {   
            // Update harga beli pada master item
            $item = Item::find($receiptDetail->item_id);
            if($item->is_cure == 1) {
                if($receiptDetail->expired_date == null) {
                    throw new Exception('Tanggal kadaluarsa harus diisi karena ' . $item->name . ' adalah obat');
                }
            }
            $item->purchase_price = $receiptDetail->purchase_price;
            $additional = $item->additional;
            if(json_encode($additional) == '[]') {

                $item->additional = json_decode('{"hna":' . $receiptDetail->hna . '}');
            } else {
                $additional->hna = $receiptDetail->hna;
                $item->additional = $additional;
            }
            $item->save();
            

            $purchase_order_detail = PurchaseOrderDetail::find($receiptDetail->purchase_order_detail_id);
            if($receiptDetail->qty <= 0) {
                throw new Exception('Minimal barang yang diterima adalah 1 item');
            }

            if($receiptDetail->qty > $purchase_order_detail->leftover_qty) {
                throw new Exception('Jumlah barang yang diterima melebihi jumlah sisa di PO');
            }

            $purchase_order_detail->increment('received_qty', $receiptDetail->qty);
            $purchase_order_detail->decrement('leftover_qty', $receiptDetail->qty);

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
                'receipt_detail_id' => $receiptDetail->id,
                'expired_date' => $receiptDetail->expired_date
            ]);

            $receiptDetail->stock_transaction_id = $stockTransaction->id;
        });
        static::created(function(ReceiptDetail $receiptDetail) {   
            // Input ke hutang
            $purchaseOrderDetail = PurchaseOrderDetail::find($receiptDetail->purchase_order_detail_id);
            $payable = new Payable();
            $payable->contact_id = $purchaseOrderDetail->purchase_order->supplier_id;
            $payable->qty = $receiptDetail->qty;
            $payable->price = $receiptDetail->purchase_price;
            $payable->discount = $receiptDetail->post_discount;
            $payable->date = Carbon::now()->format('Y-m-d');
            $payable->receipt_detail_id = $receiptDetail->id;
            $payable->save();
        });
    }

    public function getSubtotalAttribute() {
        if(array_key_exists('purchase_price', $this->attributes)) {
            $off = ($this->attributes ['qty'] ?? 0) * $this->attributes['purchase_price'] * ($this->attributes['discount'] ?? 0) / 100;
            $subtotal = ($this->attributes['qty'] ?? 0) * $this->attributes['purchase_price'] - $off;
            return $subtotal;
        }

        return 0;
    }

    public function setQtyAttribute($value) {
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
