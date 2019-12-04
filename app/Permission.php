<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends Model
{
    //
    protected $hidden = ['created_at', 'updated_at'];
    protected $guarded = ['id'];

    public static function boot() {
        parent::boot();

        static::creating(function(Permission $permission){
            if($permission->is_permission == 1)
            $permission->slug = Str::snake($permission->name);
        });
    } 
}
