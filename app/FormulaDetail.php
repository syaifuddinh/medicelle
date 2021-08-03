<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;
use App\StockTransaction;
use App\MedicalRecord;


class FormulaDetail extends Model
{
    protected $fillable = ['item_id', 'lokasi_id', 'stock_id','qty','signa1','signa2'];
    protected $hidden = ['created_at', 'updated_at'];


    public static function boot() {
        parent::boot(); 

        static::creating(function(FormulaDetail $formulaDetail) {
	//throw new Exception('Stok ID nya' . $formulaDetail->stock_id);
            if(is_null($formulaDetail->stock_id)){
            	$stock = DB::table('stocks')
            	->whereItemId($formulaDetail->item_id)
            	->whereLokasiId($formulaDetail->lokasi_id)
            	->first();           	
            }
            
            else{
            	$jum = DB::table('stocks')
            	->whereItemId($formulaDetail->item_id)
            	->sum('qty');

            	$stock2 = DB::table('stocks')
            	->whereId($formulaDetail->stock_id)
            	->first();

            	$item = DB::table('items')
            	->whereId($formulaDetail->item_id)
            	->select('name')
            	->first();

            	if($jum == null) {
                	throw new Exception('Stok ' . $item->name . ' tidak ada');
            	}

            	if($formulaDetail->qty > $jum) {
                	throw new Exception('Stok ' . $item->name . ' tidak mencukupi');
            	}
            }

            $formulaDetail->stock_id = $stock2->id; 
            
        });
    }

    public function s1() {
        return $this->belongsTo('App\Permission','signa1','id');
    }

    public function s2() {
        return $this->belongsTo('App\Permission','signa2','id');
    }


    public function item() {
        return $this->belongsTo('App\Item');
    }

    public function lokasi() {
        return $this->belongsTo('App\Permission', 'lokasi_id', 'id');
    }

    public function stock() {
        return $this->belongsTo('App\Stock');
    }
}
