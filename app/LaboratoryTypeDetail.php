<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class LaboratoryTypeDetail extends Model
{
    protected $fillable = ['laboratory_type_id', 'name', 'price', 'service_price', 'percentage'];

    public static function generateLaboratoryItem() {
        $items = DB::table('laboratory_type_details')
        ->leftJoin("laboratory_types", "laboratory_types.id", "laboratory_type_details.laboratory_type_id")
        ->leftJoin("prices AS parent_prices", "parent_prices.id", "laboratory_types.price_id")
        ->leftJoin("prices", "prices.item_id", "laboratory_type_details.item_id")
        ->whereNotNull("laboratory_type_details.item_id")
        ->select(
            "laboratory_type_details.item_id",
            "laboratory_type_details.price",
            "prices.id AS children_price_id",
            "parent_prices.grup_nota_id"
        )
        ->get();

        DB::beginTransaction();
        $items->each(function($v){
            if(!$v->children_price_id) {
                DB::table('prices')
                ->insert([
                    'item_id' => $v->item_id,
                    'grup_nota_id' => $v->grup_nota_id,
                    'qty' => 1,
                    'custom_price' => $v->price,
                    'created_by' => auth()->id(),
                    'created_at' => Carbon::now('Asia/Jakarta')
                ]);
            }
        });
        DB::commit();
    }
}
