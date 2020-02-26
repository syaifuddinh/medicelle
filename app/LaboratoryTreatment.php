<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaboratoryTreatment extends Model
{
    protected $fillable = ['price_id', 'laboratory_type_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function laboratory_type() {
        return $this->belongsTo('App\LaboratoryType');
    }
}
