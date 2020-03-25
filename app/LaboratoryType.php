<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaboratoryType extends Model
{
    protected $fillable = ['name'];

    public function laboratory_type_detail() {
        return $this->hasMany('App\LaboratoryTypeDetail');
    }    
}
