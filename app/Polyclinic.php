<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Polyclinic extends Model
{       
    //
    protected $fillable = ['name', 'code', 'is_active', 'index', 'cost_center'];
    protected $hidden = ['created_at', 'updated_at'];
}
