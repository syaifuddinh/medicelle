<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends Model
{
    //
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['name', 'description'];

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::snake($value);
    }
}
