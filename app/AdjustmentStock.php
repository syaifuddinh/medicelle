<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
 
class AdjustmentStock extends Model
{
    
    protected $fillable = ['date'];
    public static function boot() {
        parent::boot(); 

        static::creating(function(AdjustmentStock $adjustmentStock) {   
            $adjustmentStock->created_by = Auth::user()->id;
        });
    }

    public function detail() {
        return $this->hasMany('App\AdjustmentStockDetail');
    }


    public function creator() {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
}
