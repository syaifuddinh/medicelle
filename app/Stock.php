<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Stock extends Model
{
    protected $fillable = ['item_id', 'lokasi_id', 'qty', 'expired_date'];
    protected $hidden = ['created_at', 'updated_at'];


    public function item() {

        return $this->belongsTo('App\Item');
    }

    public function lokasi() {

        return $this->belongsTo('App\Permission', 'lokasi_id', 'id');
    }
}
