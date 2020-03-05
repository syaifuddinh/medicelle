<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Movement extends Model
{
    protected $fillable = ['date'];
    protected $hidden = ['created_at', 'updated_at'];
    public static function boot() {
        parent::boot(); 

        static::creating(function(Movement $movement) {   
            $movement->created_by = Auth::user()->id;
        });
    }

    public function detail() {
        return $this->hasMany('App\MovementDetail');
    }


    public function creator() {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
}
