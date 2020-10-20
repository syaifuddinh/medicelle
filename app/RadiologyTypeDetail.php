<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RadiologyTypeDetail extends Model
{
    protected $fillable = ['laboratory_type_id', 'name', 'price', 'qty', 'item_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function item() {
        return $this->belongsTo('App\Item');
    }
}
