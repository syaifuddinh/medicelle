<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Equipment extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['date', 'description'];
    protected $table = 'equipments';

    public static function boot() {
        parent::boot(); 

        static::creating(function(Equipment $equipment) {   
            $equipment->created_by = Auth::user()->id;
        });
    }

    public function user() {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function detail() {
        return $this->hasMany('App\EquipmentDetail');
    }
}
