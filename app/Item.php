<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    // public static function boot() {
    //     parent::boot();
    //     static::creating(function(Item $item) {
    //         if($item->is_disease == 1 && $item->is_category == 0) {
    //             $category = Item::find($item->category_id);

    //             $item->code = $category->code . '.' . $item->code; 
    //         } 
    //     });

    // }

    public static function disease() {
        return self::whereIsDisease(1)->whereIsCategory(0);
    }
    public static function disease_category() {
        return self::whereIsDisease(1)->whereIsCategory(1);
    }

    public function category() {
        return $this->belongsTo('App\Item', 'category_id', 'id')->whereIsDisease(1)->whereIsCategory(1);
    }
}
