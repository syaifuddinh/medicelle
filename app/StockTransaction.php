<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Stock;
use Carbon\Carbon;
use DB;
use Exception;

class StockTransaction extends Model
{
    protected $fillable = ['date', 'item_id', 'supplier_id', 'lokasi_id', 'receipt_detail_id', 'in_qty', 'out_qty', 'description'];
    protected $hidden = ['created_at', 'updated_at'];

    public static function boot() {
        parent::boot(); 

        static::creating(function(StockTransaction $stockTransaction) {   
            $qty = $stockTransaction->in_qty - $stockTransaction->out_qty;

            $stock_count = Stock::whereItemId($stockTransaction->item_id)
            ->whereLokasiId($stockTransaction->lokasi_id)
            ->count('id');

            if($stock_count == 0) {
                $stock = Stock::create([
                    'item_id' => $stockTransaction->item_id,
                    'lokasi_id' => $stockTransaction->lokasi_id,
                    'qty' => $qty
                ]);

                $stock_id = $stock->id;
            } else {
                $stock = Stock::whereItemId($stockTransaction->item_id)
                ->whereLokasiId($stockTransaction->lokasi_id);
                $stock = $stock->first();
                $stock_id = $stock->id;
                if($stock->qty + $qty < 0) {
                    throw new Exception("Stok tidak boleh minus");
                }
                $stock = Stock::whereItemId($stockTransaction->item_id)
                ->whereLokasiId($stockTransaction->lokasi_id);
                $stock->increment('qty', $qty);

            }

            $stockTransaction->stock_id = $stock_id;

            $date = Carbon::parse($stockTransaction->date);
            $year = $date->format('Y');
            $month = $date->format('m');
            $periodical_stock_count = DB::table('periodical_stocks')
            ->where('year', $year)
            ->where('month', $month)
            ->whereItemId($stockTransaction->item_id)
            ->whereLokasiId($stockTransaction->lokasi_id);

            if($periodical_stock_count->count('id') == 0) {
                DB::table('periodical_stocks')
                ->insert([
                    'year' => $year,
                    'month' => $month,
                    'item_id' => $stockTransaction->item_id,
                    'lokasi_id' => $stockTransaction->lokasi_id,
                    'gross' => $stockTransaction->in_qty ?? 0,
                    'netto' => $qty,
                    'stock_id' => $stock_id
                ]);
            } else {
                $periodical_stock = DB::table('periodical_stocks')
                ->where('year', $year)
                ->where('month', $month)
                ->whereItemId($stockTransaction->item_id)
                ->whereLokasiId($stockTransaction->lokasi_id);

                $periodical_stock->increment('gross', $stockTransaction->in_qty);
                $periodical_stock->increment('netto', $qty);
            }
            $last_stock = 0;
            $latest_stock_id = StockTransaction::whereItemId($stockTransaction->item_id)
            ->whereLokasiId($stockTransaction->lokasi_id)
            ->max('id');

            if(null != ($latest_stock_id ?? null)) {
                $latestStock = StockTransaction::find($latest_stock_id);
                $last_stock = $latestStock->amount;
            }

            $last_stock += $qty;
            $stockTransaction->amount = $last_stock;

            $item = DB::table('items') 
            ->whereId($stockTransaction->item_id);
            $item->increment('current_stock', $qty);
            $item->update([
                'has_stock' => 1
            ]);
        });
    }

    public function stock() {
        return $this->belongsTo('App\Stock');
    }
}
