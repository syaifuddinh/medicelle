<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Polyclinic extends Model
{       
    //
    protected $fillable = ['name', 'code', 'is_active', 'index', 'cost_center'];
    protected $hidden = ['created_at', 'updated_at'];


    public static function boot() {
        parent::boot();

        static::creating(function(Polyclinic $polyclinic){
            if($polyclinic->code == null || $polyclinic->code == '') {
                if(strlen($polyclinic->name) > 2) {
                    $code = strtoupper($polyclinic->name[0] . $polyclinic->name[1] . $polyclinic->name[2]);
                    $latestPolyclinic = Polyclinic::whereRaw("code LIKE '$code%'")->first();
                    if($latestPolyclinic != null) {
                        $similarPolyclinic = Polyclinic::whereRaw("code LIKE '$code%'")->count('id');
                        $code .= $similarPolyclinic;
                    }

                    $polyclinic->code = $code;
                }
            }
        });
        static::updating(function(Polyclinic $polyclinic){
            if($polyclinic->code == null || $polyclinic->code == '') {
                if(strlen($polyclinic->name) > 2) {
                    $code = strtoupper($polyclinic->name[0] . $polyclinic->name[1] . $polyclinic->name[2]);
                    $latestPolyclinic = Polyclinic::whereRaw("code LIKE '$code%'")->first();
                    if($latestPolyclinic != null) {
                        $similarPolyclinic = Polyclinic::whereRaw("code LIKE '$code%'")->count('id');
                        $code .= $similarPolyclinic;
                    }

                    $polyclinic->code = $code;
                }
            }
        });
    }
}
