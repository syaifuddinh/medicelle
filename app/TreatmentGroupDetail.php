<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Exception;

class TreatmentGroupDetail extends Model
{
    protected $fillable = ['item_id', 'qty'];
    protected $hidden = ['created_at', 'updated_at'];

    public static function boot() {
        parent::boot(); 

        static::creating(function(TreatmentGroupDetail $treatmentGroupDetail) {
            if($treatmentGroupDetail->qty == null OR $treatmentGroupDetail->qty == 0) {
                throw new Exception('Qty tidak boleh kosong');
            }
        });

    }

    public function item() {
        return $this->belongsTo('App\Item', 'item_id', 'id');
    }
}
