<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'code', 'name', 'email', 'password', 'avatar', 'group_user_id', 'fullname', 'contact_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at', 
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = ['avatar_url'];

    public function getAvatarUrlAttribute() {
        return @$this->attributes['avatar'] == null ? asset('files/person.png') : asset('files/' . $this->attributes['avatar']);
    }

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }

    public function group_user()
    {
          return $this->belongsTo('App\Permission','group_user_id','id');
    }

    public function contact()
    {
          return $this->belongsTo('App\Contact', 'contact_id', 'id')->whereId($this->contact_id);;
    }

    public function nurse()
    {
          return $this->belongsTo('App\Contact', 'contact_id', 'id')->whereIsNurse(1)->orWhere('is_nurse_helper', 1)->whereId($this->contact_id);
    }

    public function doctor()
    {
          return $this->belongsTo('App\Contact', 'contact_id', 'id')->whereIsDoctor(1)->whereId($this->contact_id);
    }

    public function allow_view_setting() {
        if( $this->is_admin == 1) {
            return 1;
        } else {
            if($this->contact_id != null) {
                $contact = $this->contact; 
                if($contact->is_nurse != 1 && $contact->is_nurse_helper != 1 && $contact->is_doctor != 1) {
                    return 1;
                }
            }
        }

        return 0;

    }

    public function allow_view_cashier() {
        if( $this->is_admin == 1) {
            return 1;
        } else {
            if($this->contact_id != null) {
                $contact = $this->contact; 
                if($contact->is_nurse != 1 && $contact->is_nurse_helper != 1 && $contact->is_doctor != 1) {
                    return 1;
                }
            }
        }

        return 0;

    }

    public function allow_view_master() {
        if( $this->is_admin == 1) {
            return 1;
        } else {
            if($this->contact_id != null) {
                $contact = $this->contact; 
                if($contact->is_nurse != 1 && $contact->is_nurse_helper != 1 && $contact->is_doctor != 1) {
                    return 1;
                }
            }
        }

        return 0;

    }

    public function allow_view_registration() {
        if( $this->is_admin == 1) {
            return 1;
        } else {
            if($this->contact_id != null) {
                $contact = $this->contact; 
                if($contact->is_nurse != 1 && $contact->is_nurse_helper != 1 && $contact->is_doctor != 1) {
                    return 1;
                }
            }
        }

        return 0;

    }

    public function allow_view_polyclinic() {
        if( $this->is_admin == 1) {
            return 1;
        } else {
            if($this->contact_id != null) {
                $contact = $this->contact; 
                if($contact->is_nurse == 1 || $contact->is_nurse_helper == 1 || $contact->is_doctor == 1) {
                    return 1;
                }
            }
        }

        return 0;

    }

    public function allow_update_assesment() {
        if( $this->is_admin == 1) {
            return 1;
        } else {
            if($this->nurse) {
                return 1;
            }
        }

        return 0;

    }

    public function allow_update_medical_record() {
        if( $this->is_admin == 1) {
            return 1;
        } else {
            if($this->doctor) {
                return 1;
            }
        }

        return 0;

    }
}
