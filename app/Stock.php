<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Stock extends Model
{
    protected $fillable = ['item_id', 'lokasi_id', 'qty'];
    protected $hidden = ['created_at', 'updated_at'];


    public function early_stock() {

        return $this->hasOne('App\PeriodicalStock')
        ->whereRaw('"month" = CASE "month" - 1 WHEN 0 THEN 12 ELSE "month" - 1 END AND "year" = CASE "month" - 1 WHEN 0 THEN "year" - 1 ELSE "year" END')->withDefault([
            'gross' => 0,
            'netto' => 0
        ]);
    }

    public function item() {

        return $this->belongsTo('App\Item');
    }

    public function lokasi() {

        return $this->belongsTo('App\Permission', 'lokasi_id', 'id');
    }
}
