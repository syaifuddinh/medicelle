<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;
use App\StockTransaction;
use Carbon\Carbon;

class EquipmentDetail extends Model
{
    protected $table = 'equipment_details';
    protected $appends = ['status_name'];
    protected $fillable = ['item_id', 'qty', 'stock_transaction_id', 'equipment_id', 'lokasi_id'];

    public static function boot() {
        parent::boot(); 

        static::creating(function(EquipmentDetail $equipmentDetail) {   
            $stock = DB::table('stocks')
            ->whereItemId($equipmentDetail->item_id)
            ->whereLokasiId($equipmentDetail->lokasi_id)
            ->sum('qty');
            if($equipmentDetail->qty > $stock) {
                throw new Exception('Jumlah barang melebihi stok');
            }
        });

        static::updating(function(EquipmentDetail $equipmentDetail) {   
            if($equipmentDetail->is_approve && !$equipmentDetail->stock_transaction_id) {
                $stock = DB::table('stocks')
                ->whereItemId($equipmentDetail->item_id)
                ->whereLokasiId($equipmentDetail->lokasi_id)
                ->sum('qty');
                if($equipmentDetail->qty > $stock) {
                    throw new Exception('Jumlah barang melebihi stok');
                }
                $stock = DB::table('stocks')
                ->whereItemId($equipmentDetail->item_id)
                ->whereLokasiId($equipmentDetail->lokasi_id)
                ->first();
                $stockTransaction = StockTransaction::create([
                    'date' => Carbon::now()->format('Y-m-d'),
                    'description' => 'Penggunaan barang ' . $equipmentDetail->item->name,
                    'item_id' => $equipmentDetail->item_id,
                    'lokasi_id' => $equipmentDetail->lokasi_id,
                    'expired_date' => $stock->expired_date,
                    'out_qty' => $equipmentDetail->qty
                ]);
            }
        });
    }

    public function item() {
        return $this->belongsTo('App\Item');
    }
    public function lokasi() {
        return $this->belongsTo('App\Permission', 'lokasi_id', 'id');
    }

    public function getStatusNameAttribute() {
        if(array_key_exists('is_approve', $this->attributes)) {
            if($this->attributes['is_approve']) {
                return 'Dikeluarkan';
            } else {
                return 'Draft';
            }
        } else {
            return '';
        }
    } 

}
