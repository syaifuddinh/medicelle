<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SideEffect extends Model
{
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];

    public function detail() {
        return $this->hasMany('App\SideEffectDetail');
    }
}
