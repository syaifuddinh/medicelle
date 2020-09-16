<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RadiologyTypeDetail extends Model
{
    protected $fillable = ['laboratory_type_id', 'name', 'price'];
    protected $hidden = ['created_at', 'updated_at'];
}
