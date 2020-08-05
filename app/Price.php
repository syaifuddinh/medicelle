<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Exception;

class Price extends Model
{
    //
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['grup_nota_id', 'destination', 'polyclinic_id', 'is_registration', 'is_sewa_ruangan','is_sewa_alkes', 'qty', 'percentage', 'radiology_group', 'laboratory_group', 'is_treatment', 'is_diagnostic', 'is_chemoterapy', 'is_specialization', 'specialization_id'];

    public static function boot() {
        parent::boot();

        static::creating(function(Price $price){
            $price->created_by = Auth::user()->id;
            if($price->is_specialization === null) {
                $price->specialization_id = 0;
            }
            if($price->is_specialization == 0) {
                $price->specialization_id = null;
            } else {
                if($price->specialization_id == null) {
                    throw new Exception('Spesialis tidak boleh kosong');
                }
            }
        });

        static::updating(function(Price $price){
            if($price->is_specialization === null) {
                $price->specialization_id = 0;
            }
            
            if($price->is_specialization == 0) {
                $price->specialization_id = null;
            } else {
                if($price->specialization_id == null) {
                    throw new Exception('Spesialis tidak boleh kosong');
                }
            }
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

    public function specialization() {
        return $this->belongsTo('App\Specialization')
        ->withDefault([
            'name' => ''
        ]);
    }

    public function laboratory_treatment() {
        return $this->hasMany('App\LaboratoryTreatment', 'price_id', 'id');
    }
}
