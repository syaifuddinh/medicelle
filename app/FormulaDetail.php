<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;
use App\StockTransaction;

class FormulaDetail extends Model
{
    protected $fillable = ['item_id', 'lokasi_id', 'qty', 'stock_id', 'stock_transaction_id'];
    protected $hidden = ['created_at', 'updated_at'];


    public static function boot() {
        parent::boot(); 

        static::creating(function(FormulaDetail $formulaDetail) {
            $stock = DB::table('stocks')
            ->whereItemId($formulaDetail->item_id)
            ->whereLokasiId($formulaDetail->lokasi_id)
            ->first();

            $item = DB::table('items')
            ->whereId($formulaDetail->item_id)
            ->select('name')
            ->first();

            if($stock == null) {
                throw new Exception('Stok ' . $item->name . ' tidak ada');
            }

            if($formulaDetail->qty > $stock->qty) {
                throw new Exception('Stok ' . $item->name . ' tidak mencukupi');
            }

            $formulaDetail->stock_id = $stock->id;
        });
    }


    public function item() {
        return $this->belongsTo('App\Item');
    }

    public function lokasi() {
        return $this->belongsTo('App\Permission', 'lokasi_id', 'id');
    }

    public function stock() {
        return $this->belongsTo('App\Stock');
    }
}
