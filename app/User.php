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

    public function setContactIdAttribute($value) {
        if($value == 'null') {
            $this->attributes['contact_id'] = null;
        } else {
            $this->attributes['contact_id'] = $value;            
        }
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

    public function allow_access($slug) {
        $outp = 0;
        if( $this->is_admin == 1) {
            return 1;
        } else {
            if($this->contact_id != null) {
                $contact = $this->contact; 
                if($contact->is_nurse != 1 && $contact->is_nurse_helper != 1 && $contact->is_doctor != 1) {
                    $outp = 1;
                }
            }
            if($this->group_user) {
                $roles = $this->group_user->roles;
                $outp = $roles->{$slug} ?? 0;
            }
        }

        return $outp;

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
            if($this->group_user) {
                $roles = $this->group_user->roles;
                return $roles->setting ?? 0;
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
            if($this->group_user) {
                $roles = $this->group_user->roles;
                return $roles->cashier ?? 0;
            }
        }

        return 0;

    }

    public function allow_view_price() {
        if( $this->is_admin == 1) {
            return 1;
        } else {
            if($this->contact_id != null) {
                $contact = $this->contact; 
                if($contact->is_nurse != 1 && $contact->is_nurse_helper != 1 && $contact->is_doctor != 1) {
                    return 1;
                }
            }
            if($this->group_user) {
                $roles = $this->group_user->roles;
                return $roles->{'setting.price'} ?? 0;
            }
        }

        return 0;
    }

    public function allow_create_discount() {
        if( $this->is_admin == 1) {
            return 1;
        } else {
            if($this->contact_id != null) {
                $contact = $this->contact; 
                if($contact->is_nurse != 1 && $contact->is_nurse_helper != 1 && $contact->is_doctor != 1) {
                    return 1;
                }
            }
            if($this->group_user) {
                $roles = $this->group_user->roles;
                return $roles->{'setting.discount.create'} ?? 0;
            }
        }

        return 0;
    }


    public function allow_edit_discount() {
        if( $this->is_admin == 1) {
            return 1;
        } else {
            if($this->contact_id != null) {
                $contact = $this->contact; 
                if($contact->is_nurse != 1 && $contact->is_nurse_helper != 1 && $contact->is_doctor != 1) {
                    return 1;
                }
            }
            if($this->group_user) {
                $roles = $this->group_user->roles;
                return $roles->{'setting.discount.edit'} ?? 0;
            }
        }

        return 0;
    }

    public function allow_show_discount() {
        if( $this->is_admin == 1) {
            return 1;
        } else {
            if($this->contact_id != null) {
                $contact = $this->contact; 
                if($contact->is_nurse != 1 && $contact->is_nurse_helper != 1 && $contact->is_doctor != 1) {
                    return 1;
                }
            }
            if($this->group_user) {
                $roles = $this->group_user->roles;
                return $roles->{'setting.discount.show'} ?? 0;
            }
        }

        return 0;
    }

    public function allow_view_patient() {
        if( $this->is_admin == 1) {
            return 1;
        } else {
            if($this->contact_id != null) {
                $contact = $this->contact; 
                if($contact->is_nurse != 1 && $contact->is_nurse_helper != 1 && $contact->is_doctor != 1) {
                    return 1;
                }
            }
            if($this->group_user) {
                $roles = $this->group_user->roles;
                return $roles->{'master.patient'} ?? 0;
            }
        }

        return 0;
    }

    public function allow_view_medical_worker() {
        if( $this->is_admin == 1) {
            return 1;
        } else {
            if($this->contact_id != null) {
                $contact = $this->contact; 
                if($contact->is_nurse != 1 && $contact->is_nurse_helper != 1 && $contact->is_doctor != 1) {
                    return 1;
                }
            }
            if($this->group_user) {
                $roles = $this->group_user->roles;
                return $roles->{'master.medical_worker'} ?? 0;
            }
        }

        return 0;
    }


    public function allow_view_employee() {
        if( $this->is_admin == 1) {
            return 1;
        } else {
            if($this->contact_id != null) {
                $contact = $this->contact; 
                if($contact->is_nurse != 1 && $contact->is_nurse_helper != 1 && $contact->is_doctor != 1) {
                    return 1;
                }
            }
            if($this->group_user) {
                $roles = $this->group_user->roles;
                return $roles->{'master.employee'} ?? 0;
            }
        }

        return 0;
    }


    public function allow_view_discount() {
        if( $this->is_admin == 1) {
            return 1;
        } else {
            if($this->contact_id != null) {
                $contact = $this->contact; 
                if($contact->is_nurse != 1 && $contact->is_nurse_helper != 1 && $contact->is_doctor != 1) {
                    return 1;
                }
            }
            if($this->group_user) {
                $roles = $this->group_user->roles;
                return $roles->{'setting.discount'} ?? 0;
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

            if($this->group_user) {
                $roles = $this->group_user->roles;
                return $roles->master ?? 0;
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
            if($this->group_user) {
                $roles = $this->group_user->roles;
                return $roles->registration ?? 0;
            }
        }

        return 0;

    }

    public function allow_view_polyclinic() {
        $is_allow = 0;
        if( $this->is_admin == 1) {
            $is_allow =  1;
        } else {
            if($this->contact_id != null) {
                $contact = $this->contact; 
                if($contact->is_nurse == 1 || $contact->is_nurse_helper == 1 || $contact->is_doctor == 1) {
                    $is_allow = 1;
                }
                return $is_allow;
            }
            if($this->group_user) {
                $roles = $this->group_user->roles;
                $is_allow = $roles->polyclinic ?? 0;
            }
        }
        return $is_allow;

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
            if($this->contact) {
                $contact = $this->contact;
                if($contact->is_doctor == 1 || $contact->is_nurse == 1 || $contact->is_nurse_helper == 1)
                return 1;
            }
        }

        return 0;

    }
}
