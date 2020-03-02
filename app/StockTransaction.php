<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Stock;
use Carbon\Carbon;
use DB;

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

                $stock->increment('qty', $qty);
                $stock_id = $stock->first()->id;
            }

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
                    'netto' => $stockTransaction->out_qty ?? 0,
                    'stock_id' => $stock_id
                ]);
            }
        });
    }
}
