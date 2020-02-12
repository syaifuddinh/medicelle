<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Price;

class Item extends Model
{
    protected $fillable = ['name', 'code', 'category_id', 'is_category', 'description', 'price', 'purchase_price', 'supplier_price', 'piece_id', 'purchase_piece_id', 'minimal_stock', 'ratio', 'additional', 'is_cure', 'is_non_cure', 'is_umum', 'is_alkes_disposible', 'is_alkes_non_disposible', 'is_inventaris', 'is_bhp', 'classification_id', 'subclassification_id', 'generic_id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['unique_code', 'rate'];

    public static function boot() {
        parent::boot();

        static::created(function(Item $item) {

            // Is Active a.k.a grup nota id
            if($item->is_medical_item == 1  && $item->is_category == 0 && $item->category_id!= null && $item->is_pharmacy > 0) {
                $price = Price::whereItemId($item->id)->first();
                if($price != null) {

                    $price = Price::find($price->id);
                    $price->grup_nota_id = $item->is_pharmacy;
                    $price->save();
                } else {
                        $price = new Price();
                        $price->item_id = $item->id;
                        $price->is_registration = 0;
                        $price->grup_nota_id = $item->is_pharmacy;
                        $price->save();

                }
                $item->is_pharmacy = 0;
            }

        });

        static::updating(function(Item $item) {
            // Is Active a.k.a grup nota id

            if($item->is_medical_item == 1 && $item->is_category == 0 && $item->category_id != null && $item->is_pharmacy > 0) {
                $price = Price::whereItemId($item->id)->first();
                if($price != null) {
                    $price = Price::find($price->id);
                    $price->grup_nota_id = $item->is_pharmacy;
                    $price->save();
                    $item->is_pharmacy = 1;
                } else {
                    $price = new Price();
                    $price->item_id = $item->id;
                    $price->is_registration = 0;
                    $price->grup_nota_id = $item->is_pharmacy;
                    $price->save();

                }
            }

        });

    }

    public function getAdditionalAttribute() {
        if(array_key_exists('additional', $this->attributes)) {
            $additional = json_decode($this->attributes['additional']);
            return $additional;
        }
        return json_decode('{}');
    }

    public function setAdditionalAttribute($value) {
        $this->attributes['additional'] = json_encode($value);    
    }


    public function getUniqueCodeAttribute() {
        $attr = $this->attributes;
        if(array_key_exists('code', $attr)) {
            $code = str_pad($attr['code'], 3, '0', STR_PAD_LEFT);

            if(array_key_exists('category_id', $attr)) {
                if($attr['category_id'] != null) {
                    $prefix =  str_pad($this->group->code, 3, '0', STR_PAD_LEFT);
                    $code = $prefix . '.' . $code;
                }
            }

            return $code;

        }

        return null;
    }
    public function getRateAttribute() {
        if(array_key_exists('price', $this->attributes)) {
            return $this->attributes['price'];
        }
        return null;
    }

    public static function disease() {
        return self::whereIsDisease(1)->whereIsCategory(0);
    }

    public static function administration() {
        return self::whereIsAdministration(1);
    }


    public static function laboratory() {
        return self::whereIsLaboratory(1);
    }


    public static function radiology() {
        return self::whereIsRadiology(1);
    }

    public static function cure() {
        return self::whereIsCure(1);
    }

    public static function medical_item() {
        return self::whereIsMedicalItem(1);
    }

    public static function bhp() {
        return self::whereIsBhp(1);
    }

    public static function disease_category() {
        return self::whereIsDisease(1)->whereIsCategory(1);
    }

    public static function medical_item_category() {
        return self::whereIsMedicalItem(1)->whereIsCategory(1);
    }

    public function category() {
        return $this->belongsTo('App\Item', 'category_id', 'id')->whereIsDisease(1)->whereIsCategory(1);
    }

    public function group() {
        return $this->belongsTo('App\Item', 'category_id', 'id');
    }
    public function piece() {
        return $this->belongsTo('App\Piece');
    }

    public function administration_category() {
        return $this->belongsTo('App\Item', 'category_id', 'id')->whereIsAdministration(1);
    }

    public function laboratory_category() {
        return $this->belongsTo('App\Item', 'category_id', 'id')->whereIsLaboratory(1);
    }

    public function radiology_category() {
        return $this->belongsTo('App\Item', 'category_id', 'id')->whereIsRadiology(1);
    }


    public function cure_category() {
        return $this->belongsTo('App\Item', 'category_id', 'id')->whereIsCure(1);
    }

    public function bhp_category() {
        return $this->belongsTo('App\Item', 'category_id', 'id')->whereIsBhp(1);
    }

    public function price() {
        return $this->hasOne('App\Price', 'item_id', 'id');
    }
}
