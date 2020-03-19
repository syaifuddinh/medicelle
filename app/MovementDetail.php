<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StockTransaction;
use Carbon\Carbon;
use Exception;
use DB;

class MovementDetail extends Model
{
    protected $fillable = ['item_id', 'qty',  'lokasi_awal_id', 'lokasi_akhir_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public static function boot() {
        parent::boot(); 

        static::creating(function(MovementDetail $movementDetail) {   
            if($movementDetail->lokasi_awal_id == null) {
                throw new Exception('Lokasi awal tidak boleh kosong');
            } 

            if($movementDetail->lokasi_akhir_id == null) {
                throw new Exception('Lokasi akhir tidak boleh kosong');
            } 

            if($movementDetail->lokasi_akhir_id == $movementDetail->lokasi_awal_id) {
                throw new Exception('Lokasi akhir dan lokasi awal tidak boleh sama');
            } 
            if(($movementDetail->qty || 0) == 0) {
                throw new Exception('Qty tidak boleh kosong');
            } 

            $stock = DB::table('stocks')
            ->whereItemId($movementDetail->item_id)
            ->whereLokasiId($movementDetail->lokasi_awal_id)
            ->select('id', 'qty', 'expired_date')
            ->first();

            if($movementDetail->qty > ($stock->qty ?? 0)) {
                $item = DB::table('items')
                ->whereId($movementDetail->item_id)
                ->select('name')
                ->first();
                throw new Exception("Jumlah " . $item->name . ' yang akan dipindahkan melebihi stok');
            } else {
                $movementDetail->stock_awal_id = $stock->id;
            }

            $stockTransactionSource = StockTransaction::create([
                'date' => Carbon::now()->format('Y-m-d'),
                'description' => 'Perpindahan Barang dari Lokasi Awal',
                'item_id' => $movementDetail->item_id,
                'in_qty' => $movementDetail->qty,
                'lokasi_id' => $movementDetail->lokasi_awal_id,
                'expired_date' => $stock->expired_date
            ]);

            $stockTransactionDestination = StockTransaction::create([
                'date' => Carbon::now()->format('Y-m-d'),
                'description' => 'Perpindahan Barang ke Lokasi Akhir',
                'item_id' => $movementDetail->item_id,
                'in_qty' => $movementDetail->qty,
                'lokasi_id' => $movementDetail->lokasi_akhir_id,
                'expired_date' => $stock->expired_date
            ]);

            $movementDetail->stock_transaction_source_id = $stockTransactionSource->id;
            $movementDetail->stock_transaction_destination_id = $stockTransactionDestination->id;

        });
    }


    public function item() {
        return $this->belongsTo('App\Item');
    }

    public function lokasi_awal() {
        return $this->belongsTo('App\Permission', 'lokasi_awal_id', 'id');
    }

    public function lokasi_akhir() {
        return $this->belongsTo('App\Permission', 'lokasi_akhir_id', 'id');
    }

    public function stock_transaction_source() {
        return $this->belongsTo('App\StockTransaction', 'stock_transaction_source_id', 'id');
    }

    public function stock_transaction_destination() {
        return $this->belongsTo('App\StockTransaction', 'stock_transaction_destination_id', 'id');
    }
}
