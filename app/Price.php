<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Price extends Model
{
    //
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['grup_nota_id', 'destination', 'polyclinic_id', 'is_registration', 'is_sewa_ruangan','is_sewa_alkes', 'qty', 'percentage', 'radiology_group', 'laboratory_group', 'is_treatment', 'is_diagnostic', 'is_chemoterapy'];

    public static function boot() {
        parent::boot();

        static::creating(function(Price $price){
            $price->created_by = Auth::user()->id;
        });
    }

    public function radiology_type() {
        return $this->belongsTo('App\RadiologyType', 'radiology_group', 'id');
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

    public function laboratory_treatment() {
        return $this->hasMany('App\LaboratoryTreatment', 'price_id', 'id');
    }
}
