<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Specialization extends Model
{
    //
    protected $fillable = ['name', 'code', 'doctor_roles', 'nurse_roles', 'is_active'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['doctor_roles', 'doctor_roles'];

    public static function boot() {
        parent::boot();

        static::creating(function(Specialization $specialization){
            if($specialization->code == null || $specialization->code == '') {
                if(strlen($specialization->name) > 2) {
                    $code = strtoupper($specialization->name[0] . $specialization->name[1]);
                    $latestSpecialization = Specialization::whereRaw("code LIKE '$code%'")->first();
                    if($latestSpecialization != null) {
                        $similarSpecialization = Specialization::whereRaw("code LIKE '$code%'")->count('id');
                        $code .= $similarSpecialization;
                    }

                    $specialization->code = $code;
                }
            }
        });
        static::updating(function(Specialization $specialization){
            if($specialization->code == null || $specialization->code == '') {
                if(strlen($specialization->name) > 2) {
                    $code = strtoupper($specialization->name[0] . $specialization->name[1]);
                    $latestSpecialization = Specialization::whereRaw("code LIKE '$code%'")->first();
                    if($latestSpecialization != null) {
                        $similarSpecialization = Specialization::whereRaw("code LIKE '$code%'")->count('id');
                        $code .= $similarSpecialization;
                    }

                    $specialization->code = $code;
                }
            }
        });
    }


    public function setDoctorRolesAttribute($value) {
        if(json_encode($value) != '[]') {
            $this->attributes['doctor_roles'] = json_encode($value);    
        } else {
            $this->attributes['doctor_roles'] = '[]';                
        }
    }

    public function setNurseRolesAttribute($value) {
        if(json_encode($value) != '[]') {
            $this->attributes['nurse_roles'] = json_encode($value);    
        } else {
            $this->attributes['nurse_roles'] = '[]';                
        }
    }

    public function getDoctorRolesAttribute() {
        if(array_key_exists('doctor_roles', $this->attributes)) {
            if($this->attributes['doctor_roles'] == '[]') {            
                $doctor_roles = json_decode('{}');
            } else {
                $doctor_roles = json_decode($this->attributes['doctor_roles']);
            }
            return $doctor_roles;
        }
        return json_decode('{}');
    }

    public function getNurseRolesAttribute() {
        if(array_key_exists('nurse_roles', $this->attributes)) {
            if($this->attributes['nurse_roles'] == '[]') {            
                $nurse_roles = json_decode('{}');
            } else {
                $nurse_roles = json_decode($this->attributes['nurse_roles']);
            }
            return $nurse_roles;
        }
        return json_decode('{}');
    }

    public static function allow_access($medical_record_part) {
        $user = Auth::user();
        $is_allow = $user->is_admin == 1 ? 1 : 0;
        if($user->contact) {
            $contact = $user->contact;
            if($contact->specialization) {
                if($contact->is_doctor == 1 || $contact->is_nurse == 1 || $contact->is_nurse_helper == 1) {
                    if($contact->is_doctor == 1) {
                        $column = 'doctor_roles';
                    } else {
                        $column = 'nurse_roles';                        
                    }
                    if(isset($contact->specialization->{$column}->{$medical_record_part})) {
                        if($contact->specialization->{$column}->{$medical_record_part} == 1) {
                            $is_allow = 1;
                        } 
                    }
                }
            }
        }

        return $is_allow;
    }
}
