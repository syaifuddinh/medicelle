<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends Model
{
    //
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['roles'];
    protected $guarded = ['id'];

    public static function boot() {
        parent::boot();

        static::creating(function(Permission $permission){
            if($permission->is_permission == 1 || $permission->is_signa == 1)
                $permission->slug = Str::random() . Str::snake($permission->name);
        });

        static::updating(function(Permission $permission){
            if($permission->is_permission == 1 || $permission->is_signa == 1)
                $permission->slug = Str::random(3) . Str::snake($permission->name);
        });
    } 

    public function getRolesAttribute(){ 
        if(array_key_exists('roles', $this->attributes)) {
            return json_decode($this->attributes['roles']);
        }
        return null;
    }
}
