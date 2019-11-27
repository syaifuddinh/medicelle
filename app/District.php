<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name', 'city_id'];
    protected $hidden = ['created_at', 'updated_at'];
}
