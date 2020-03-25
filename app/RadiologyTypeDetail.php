<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RadiologyTypeDetail extends Model
{
    protected $fillable = ['laboratory_type_id', 'name'];
    protected $hidden = ['created_at', 'updated_at'];
}
