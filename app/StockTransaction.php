<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Stock;
use Carbon\Carbon;
use DB;
use Exception;

class StockTransaction extends Model
{
    protected $fillable = ['date', 'item_id', 'supplier_id', 'lokasi_id', 'receipt_detail_id', 'in_qty', 'out_qty', 'description', 'expired_date', 'is_adjustment'];
    protected $hidden = ['created_at', 'updated_at'];

    public static function boot() {
        parent::boot(); 

        static::creating(function(StockTransaction $stockTransaction) {
            $item = DB::table('items')
            ->whereId($stockTransaction->item_id)
            ->first();
            if($item->is_cure == 1) {
                if($stockTransaction->expired_date == null) {
                    throw new Exception('Tanggal kadaluarsa harus diisi karena ' . $item->name . ' adalah obat');
                }
            }

            $qty = $stockTransaction->in_qty - $stockTransaction->out_qty;

            if($stockTransaction->expired_date == null) {

                $stock_count = Stock::whereItemId($stockTransaction->item_id)
                ->whereLokasiId($stockTransaction->lokasi_id)
                ->whereNull('expired_date')
                ->count('id');
            } else {
                if($stockTransaction->is_adjustment == 1) {
                    $stock_count = Stock::whereItemId($stockTransaction->item_id)
                    ->whereLokasiId($stockTransaction->lokasi_id)
                    ->count('id');                
                } else {
                    $stock_count = Stock::whereItemId($stockTransaction->item_id)
                    ->whereLokasiId($stockTransaction->lokasi_id)
                    ->whereExpiredDate($stockTransaction->expired_date)
                    ->count('id');                
                }
            }

            if($stock_count == 0) {
                $stock = Stock::create([
                    'item_id' => $stockTransaction->item_id,
                    'lokasi_id' => $stockTransaction->lokasi_id,
                    'expired_date' => $stockTransaction->expired_date,
                    'qty' => $qty
                ]);

                $stock_id = $stock->id;
            } else {
                $stock = Stock::whereItemId($stockTransaction->item_id)
                ->whereLokasiId($stockTransaction->lokasi_id);

                if($stockTransaction->is_adjustment == 0) {
                    if($stockTransaction->expired_date == null) {
                        $stock = $stock->whereNull('expired_date');                    
                    } else {
                        $stock = $stock->whereExpiredDate($stockTransaction->expired_date);
                    }
                }
                
                $stock = $stock->first();
                $stock_id = $stock->id;
                if($stock->qty + $qty < 0) {
                    throw new Exception("Stok tidak boleh minus");
                }

                $stock = Stock::whereItemId($stockTransaction->item_id)
                ->whereLokasiId($stockTransaction->lokasi_id);
                if($stockTransaction->is_adjustment == 0) {
                    if($stockTransaction->expired_date == null) {
                        $stock = $stock->whereNull('expired_date');                    
                    } else {
                        $stock = $stock->whereExpiredDate($stockTransaction->expired_date);
                    }
                }
                $stock->increment('qty', $qty);
                if($stockTransaction->is_adjustment == 1) {
                    $stock->update([
                        'expired_date' => $stockTransaction->expired_date
                    ]);
                }

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
            if($stockTransaction->expired_date == null) {
                $periodical_stock_count = $periodical_stock_count->whereNull('expired_date');                    
            } else {
                $periodical_stock_count = $periodical_stock_count->whereExpiredDate($stockTransaction->expired_date);
            }

            if($periodical_stock_count->count('id') == 0) {
                DB::table('periodical_stocks')
                ->insert([
                    'year' => $year,
                    'month' => $month,
                    'item_id' => $stockTransaction->item_id,
                    'lokasi_id' => $stockTransaction->lokasi_id,
                    'expired_date' => $stockTransaction->expired_date,
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

                if($stockTransaction->expired_date == null) {
                    $periodical_stock = $periodical_stock->whereNull('expired_date');                    
                } else {
                    $periodical_stock = $periodical_stock->whereExpiredDate($stockTransaction->expired_date);
                }

                $periodical_stock->increment('gross', $stockTransaction->in_qty);
                $periodical_stock->increment('netto', $qty);
            }
            $last_stock = 0;
            $latest_stock_id = StockTransaction::whereItemId($stockTransaction->item_id)
            ->whereLokasiId($stockTransaction->lokasi_id);
            if($stockTransaction->expired_date == null) {
                $latest_stock_id = $latest_stock_id->whereNull('expired_date');                    
            } else {
                $latest_stock_id = $latest_stock_id->whereExpiredDate($stockTransaction->expired_date);
            }

            $latest_stock_id = $latest_stock_id->max('id');

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
        return $this->belongsTo('App\Stock')->withDefault([
            'expired_date' => null
        ]);
    }
}
