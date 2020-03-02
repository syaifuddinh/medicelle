<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PeriodicalStock extends Model
{
    protected $fillable = ['year', 'month', 'item_id', 'lokasi_id', 'gross', 'netto'];
    protected $hidden = ['created_at', 'updated_at'];
}
