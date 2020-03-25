<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RadiologyType extends Model
{
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];

    public function radiology_type_detail() {
        return $this->hasMany('App\RadiologyTypeDetail');
    }
}
