<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected $hidden = ['created_at', 'updated_at'];

    public function province() {
        return $this->belongsTo('App\Province');
    }
}
