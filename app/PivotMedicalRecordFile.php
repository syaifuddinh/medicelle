<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PivotMedicalRecordFile extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['filename', 'name'];
    protected $appends = ['url'];

    public function getUrlAttribute() {
        if(array_key_exists('filename', $this->attributes)) {
            $r = url('files/' . $this->attributes['filename']);
        } else {
            $r = null;
        } 

        return $r;
    }
}
