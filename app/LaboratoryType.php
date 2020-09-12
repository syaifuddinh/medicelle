<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaboratoryType extends Model
{
    protected $fillable = ['name', 'price_id'];

    public function laboratory_type_detail() {
        return $this->hasMany('App\LaboratoryTypeDetail');
    }    

    
    public function price() {
        return $this->belongsTo('App\Price');
    }
}
