<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Price extends Model
{
    //
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['grup_nota_id', 'destination', 'polyclinic_id', 'is_registration', 'is_sewa_ruangan','is_sewa_alkes', 'qty', 'percentage'];

    public static function boot() {
        parent::boot();

        static::creating(function(Price $price){
            $price->created_by = Auth::user()->id;
        });
    }

    public function service() {
        return $this->belongsTo('App\Item', 'item_id', 'id');
    }

    public function polyclinic() {
        return $this->belongsTo('App\Polyclinic', 'polyclinic_id', 'id');
    }

    public function grup_nota() {
        return $this->belongsTo('App\Permission')->whereIsGrupNota(1);
    }
}
