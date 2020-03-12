<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Mod;
use Carbon\Carbon;

class Notification extends Model
{
    protected $fillable = ['user_id', 'title', 'description', 'stock_id', 'route', 'param', 'created_at'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['route_link'];



    public function getRouteLinkAttribute() {
        if(array_key_exists('route', $this->attributes)) {
            return route($this->attributes['route']);
        }
    }

    public static function generateExpiredCure() {
        $user_id = Auth::user()->id;
        $today = Carbon::now()->format('Y-m-d');
        $unreadStock = DB::table('stocks')
        ->whereRaw('id NOT IN (SELECT stock_id FROM notifications WHERE user_id = ' . $user_id .  ' AND DATE_PART(\'doy\', notifications.created_at) - DATE_PART(\'doy\', \'' . $today . '\'::timestamp) = 0 )')
        ->whereNotNull('expired_date')
        ->selectRaw('stocks.*, DATE_PART(\'doy\', stocks.expired_date) - DATE_PART(\'doy\', \'' . $today . '\'::timestamp) AS batas_kadaluarsa')
        ->get();
        DB::beginTransaction();
        foreach ($unreadStock as $stock) {
            $item = DB::table('items')
            ->whereId($stock->item_id)
            ->select('name')
            ->first();
            if($stock->batas_kadaluarsa > 0 && $stock->batas_kadaluarsa <= 90) {
                Notification::create([
                    'user_id' => $user_id, 
                    'title' => 'Ada obat yang akan kadaluarsa',
                    'description' => $item->name . ' akan kadaluarsa dalam waktu ' . $stock->batas_kadaluarsa . ' hari lagi',
                    'route' => 'pharmacy.report.history',
                    'stock_id' => $stock->id
                ]);
            } else if($stock->batas_kadaluarsa <= 0) {
                Notification::create([
                    'user_id' => $user_id, 
                    'title' => 'Ada obat yang sudah kadaluarsa',
                    'description' => $item->name . ' sudah kadaluarsa pada tanggal ' . Mod::fullDate($stock->expired_date),
                    'route' => 'pharmacy.report.history',
                    'stock_id' => $stock->id
                ]);

            }
        }
        DB::commit();
    }
}
