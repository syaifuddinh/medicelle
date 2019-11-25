<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    //
    protected $fillable = ['name', 'code', 'is_active'];
    protected $hidden = ['created_at', 'updated_at'];
}
