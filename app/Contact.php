<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\District;
use App\Village;
use DB;
use Str;
use Auth;

class Contact extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['id', 'code', 'name', 'address', 'postal_code', 'city_id', 'group_user_id', 'province_id', 'fax', 'phone', 'is_agency', 'is_supplier', 'is_employee', 'is_doctor', 'is_nurse', 'is_nurse_helper', 'is_patient', 'is_family', 'agency_type', 'supplier_disc_percent', 'email', 'gender', 'pin', 'birth_place', 'marriage_status', 'contact_id', 'birth_date', 'start_date', 'pharmacy_disc_percent', 'lab_sender_fee_value', 'lab_sender_fee_value', 'lab_refer_sender_fee_value', 'xray_read_fee_value', 'xray_sender_fee_value', 'usg_read_fee_value', 'usg_sender_fee_value', 'ecg_read_fee_value', 'ecg_sender_fee_value', 'medical_action_fee_value', 'consultation_fee_value', 'specialization_id', 'polyclinic_id', 'age', 'civil_code', 'district_id', 'village_id', 'created_by','updated_by', 'patient_type', 'religion', 'job', 'blood_type'];

    public static function boot() {
        parent::boot();
        static::creating(function(Contact $contact) {
            $contact->created_by = Auth::user()->id;
            if($contact->is_doctor == 1) {
                $id = DB::table('contacts')->whereIsDoctor(1)->count('id') + 1;
                $id = $id == null ? 1 : $id;
                $id = str_pad($id, 4, '0', STR_PAD_LEFT);
                $code = 'D-' . $id;

                $contact->code = $code; 
            } else if($contact->is_nurse == 1) {
                $id = DB::table('contacts')->whereIsNurse(1)->count('id') + 1;
                $id = $id == null ? 1 : $id;
                $id = str_pad($id, 4, '0', STR_PAD_LEFT);
                $code = 'P-' . $id;
                // dd($code);

                $contact->code = $code; 
            } else if($contact->is_nurse_helper == 1) {
                $id = DB::table('contacts')->whereIsNurseHelper(1)->count('id') + 1;
                $id = $id == null ? 1 : $id;
                $id = str_pad($id, 4, '0', STR_PAD_LEFT);
                $code = 'A-' . $id;
                // dd($code);

                $contact->code = $code; 
            }
        });

        static::created(function(Contact $contact) {
            if($contact->is_employee == 1 || $contact->is_doctor == 1 || $contact->is_nurse == 1 || $contact->is_nurse_helper == 1) {
                DB::beginTransaction();
                $user = new User();
                $user->fill($contact->toArray());
                $user->contact_id = $contact->id;
                $user->fullname = $contact->name;
                $user->password = '12345';
                $contact_name = preg_replace('/\s/', '_', strtolower($contact->name));
                $user->username = $contact_name;
                $user->email = $contact_name . '@email.com';
                $user->save();
                DB::commit();
            }        });

        static::updating(function(Contact $contact) {
            $contact->updated_by = Auth::user()->id;
        });

        static::updated(function(Contact $contact) {
            if($contact->is_employee == 1 || $contact->is_doctor == 1 || $contact->is_nurse == 1 || $contact->is_nurse_helper == 1) {
                DB::beginTransaction();
                $user = User::whereContactId($contact->id)->first();
                if($user != null) {
                    
                    $user = User::find($user->id);
                    $user->fill(
                        collect($contact->toArray())
                        ->except('email')
                        ->except('is_doctor')
                        ->toArray()
                    );
                    $user->contact_id = $contact->id;
                    $user->save();
                } 
                DB::commit();
            }
        });
    }

    public static function supplier() {
        return self::whereIsSupplier(1);
    }

    public static function agency() {
        return self::whereIsAgency(1);
    }

    public static function employee() {
        return self::whereIsEmployee(1);
    }

    public static function doctor() {
        return self::whereIsDoctor(1);
    }

    public static function nurse() {
        return self::whereIsNurse(1);
    }

    public static function nurse_helper() {
        return self::whereIsNurseHelper(1);
    }

    public static function patient() {
        return self::whereIsPatient(1);
    }

    public function city() {
        return $this->belongsTo('App\City');
    }

    public function district() {
        return $this->belongsTo('App\District');
    }

    public function village() {
        return $this->belongsTo('App\Village');
    }

    public function specialization() {
        return $this->belongsTo('App\Specialization');
    }

    public function polyclinic() {
        return $this->belongsTo('App\Polyclinic');
    }

    public function group_user() {
        return $this->belongsTo('App\Permission');
    }

    public function province() {
        return $this->belongsTo('App\Province');
    }

    public function contact() {
        return $this->belongsTo('App\Contact');
    }

    public function family() {
        return $this->belongsTo('App\Contact', 'contact_id', 'id')->whereIsFamily(1);
    }

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value == null ? '-' : $value;
    }

    public function setDistrictIdAttribute($value) {
        if($value != null) {
            if(!preg_match('/\d+/', $value)) {
                $d = District::create([
                    'name' => $value,
                    'city_id' => $this->attributes['city_id'] 
                ]);
                $this->attributes['district_id'] = $d->id;
            } else {
                $this->attributes['district_id'] = $value;
            }
        }
    }

    public function setVillageIdAttribute($value) {
        if($value != null) {
            if(!preg_match('/\d+/', $value)) {
                $v = Village::create([
                    'name' => $value,
                    'district_id' => $this->attributes['district_id'] 
                ]);
                $this->attributes['village_id'] = $v->id;
            } else {
                $this->attributes['village_id'] = $value;
            }
        }
    }

}
