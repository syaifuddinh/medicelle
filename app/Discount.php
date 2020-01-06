<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Discount extends Model
{
    //
    public static function boot() {
        parent::boot();

        static::creating(function(Discount $discount){
            $discount->created_by = Auth::user()->id;
        });
    }

    protected $fillable = [
        'name', 'is_active', 'code', 'type', 'description', 'date_start', 'date_end', 'disc_value', 'disc_percent', 'created_by'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 
    ];
}
