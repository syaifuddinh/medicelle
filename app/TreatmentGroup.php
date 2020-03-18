<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Exception;

class TreatmentGroup extends Model
{
    protected $fillable = ['item_id', 'grup_nota_id', 'percentage'];
    protected $hidden = ['created_at', 'updated_at'];

    public function detail() {
        return $this->hasMany('App\TreatmentGroupDetail');
    }

    public function item() {
        return $this->belongsTo('App\Item', 'item_id', 'id');
    }
    
    public function grup_nota() {
        return $this->belongsTo('App\Permission', 'grup_nota_id', 'id');
    }
}
