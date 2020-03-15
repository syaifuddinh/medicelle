<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StockTransaction;
use Carbon\Carbon;
use DB;
use Exception;

class AdjustmentStockDetail extends Model
{
    protected $fillable = ['item_id', 'previous_qty', 'qty',  'lokasi_id', 'expired_date', 'previous_expired_date'];

    protected $hidden = ['created_at', 'updated_at'];

    public static function boot() {
        parent::boot(); 

        static::creating(function(AdjustmentStockDetail $adjustmentStockDetail) {   
            if($adjustmentStockDetail->qty < 0) {
                throw new Exception("Qty tidak boleh kurang dari sama dengan 0");
            }

            $stock = DB::table('stocks')
            ->whereItemId($adjustmentStockDetail->item_id)
            ->whereLokasiId($adjustmentStockDetail->lokasi_id)
            ->whereExpiredDate($adjustmentStockDetail->previous_expired_date)
            ->select('id', 'qty', 'expired_date')
            ->first();

            $previous_qty = $stock->qty ?? 0;
            if($previous_qty > 0) {
                $adjustmentStockDetail->previous_qty = $previous_qty;
                $adjustmentStockDetail->previous_expired_date = $stock->expired_date ?? null;
                $adjustmentStockDetail->stock_awal_id = $stock->id;
            } else {
                $adjustmentStockDetail->previous_qty = 0;                
            }

            if($adjustmentStockDetail->qty == $previous_qty) {
                throw new Exception("Qty asli tidak boleh sama dengan qty sistem");
            }

            if($adjustmentStockDetail->qty > $previous_qty) {
                $in_qty = $adjustmentStockDetail->qty - $previous_qty;
                $out_qty = 0;
            } else {
                $in_qty = 0;
                $out_qty = $previous_qty - $adjustmentStockDetail->qty;
            }

            $stockTransaction = StockTransaction::create([
                'date' => Carbon::now()->format('Y-m-d'),
                'description' => 'Stok opname',
                'item_id' => $adjustmentStockDetail->item_id,
                'in_qty' => $in_qty,
                'out_qty' => $out_qty,
                'lokasi_id' => $adjustmentStockDetail->lokasi_id,
                'expired_date' => $adjustmentStockDetail->expired_date,
                'is_adjustment' =>  1
            ]);

            $adjustmentStockDetail->stock_transaction_id = $stockTransaction->id;
        });
    }


    public function lokasi() {
        return $this->belongsTo('App\Permission', 'lokasi_id', 'id');
    }

    public function item() {
        return $this->belongsTo('App\Item');
    }


    public function stock_transaction() {
        return $this->belongsTo('App\StockTransaction', 'stock_transaction_id', 'id');
    }
}
