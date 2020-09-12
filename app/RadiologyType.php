<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RadiologyType extends Model
{
    protected $fillable = ['name', 'price_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function radiology_type_detail() {
        return $this->hasMany('App\RadiologyTypeDetail');
    }

    public function price() {
        return $this->belongsTo('App\Price');
    }
}
