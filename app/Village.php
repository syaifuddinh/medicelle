<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $fillable = ['name', 'district_id'];
    protected $hidden = ['created_at', 'updated_at'];
}
