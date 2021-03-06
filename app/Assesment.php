<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Contact;
use App\Registration;
use App\MedicalRecord;
use DB;

class Assesment extends Model
{
    protected $appends = ['additional'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['step', 'date', 'registration_id', 'patient_id', 'created_by', 'updated_by', 'is_disturb','pain_score','main_complaint','pain_description','fallen','fallen_description','secondary_diagnose','secondary_diagnose_description','helper','helper_description','infus','infus_description','walking','walking_description','mental','mental_description','risk_level','risk_level_status','risk_level_description','menarche_age','siklus_haid','jumlah_pemakaian_pembalut','lama_pemakaian_pembalut','is_tidy','hpht','haid_complaint','marriage_status','marriage_duration','is_pernah_kb','kb_item','kb_start_time','kb_complaint','gravida','partus','abortus','imunisasi_tt','pada_usia_kehamilan','pemakaian_obat_saat_kehamilan','keluhan_saat_kehamilan','general_condition','gigi_tumbuh_pertama','long','weight','blood_pressure','pulse','temperature','breath_frequency','prebirth_weight','postbirth_weight','birth_long','birth_weight','head_size','arm_size','berguling_usia','duduk_usia','merangkak_usia','berdiri_usia','berjalan_usia','bicara_usia', 'additional'];

    public static function boot() {
        parent::boot();

        static::creating(function(Assesment $assesment){
            $assesment->date = date('Y-m-d');
            $assesment->created_by = Auth::user()->id;

        });

        static::created(function(Assesment $assesment){
            $patient = Contact::find($assesment->patient_id);
            $patient->assesment_id = $assesment->id;
            $patient->save();
        });

        static::updating(function(Assesment $assesment){
            $assesment->updated_by = Auth::user()->id;
            $registration = Registration::find($assesment->registration_id);
            $registrationDetail = $registration->detail;
            $additional = $assesment->additional;
            $params = [
                'riwayat_penyakit_dahulu' => $additional->riwayat_penyakit_dahulu ?? ''
            ];
            $params = (object) $params;
            $m = MedicalRecord::whereRegistrationId($assesment->registration_id) 
            ->first();
            if($m) {
                $medicalRecord = MedicalRecord::find($m->id);
                $medicalRecord->additional = $params;
                $medicalRecord->save();
            }
            foreach($registrationDetail as $unit) {
                $params = [
                    'current_disease' => $additional->riwayat_penyakit_sekarang ?? '',
                    'main_complaint' => $assesment->main_complaint,
                    'obgyn_main_complaint' => $assesment->main_complaint,
                    'general_condition' => $assesment->general_condition,
                    'long' => $assesment->long,
                    'weight' => $assesment->weight,
                    'blood_pressure' => $assesment->blood_pressure,
                    'pulse' => $assesment->pulse,
                    'temperature' => $assesment->temperature,
                    'breath_frequency' => $assesment->breath_frequency,
                    'postbirth_weight' => $assesment->postbirth_weight,
                    'menarche_age' => $assesment->menarche_age,
                    'siklus_haid' => $assesment->siklus_haid,
                    'jumlah_pemakaian_pembalut' => $assesment->jumlah_pemakaian_pembalut,
                    'lama_pemakaian_pembalut' => $assesment->lama_pemakaian_pembalut,
                    'lama_pemakaian_pembalut' => $assesment->lama_pemakaian_pembalut,
                    'is_tidy' => $assesment->is_tidy,
                    'hpht' => $assesment->hpht,
                    'haid_complaint' => $assesment->haid_complaint,
                    'obgyn_current_disease' => $assesment->additional->riwayat_penyakit_sekarang
                ];
                if(!$unit->medical_record->current_disease) {
                    $params['current_disease'] = $assesment->additional->riwayat_penyakit_sekarang ?? '';
                }
				$params['marriage_status'] = $assesment->marriage_status ?? '';
				$params['marriage_duration'] = $assesment->marriage_duration ?? '';
				$unit->medical_record()->update($params);
				$params = (object) $params;
				/*
				if($assesment->is_pernah_kb==1){
				$params['is_kb_history'] = 1;
				$params['name'] = $assesment->kb_item ?? '';
				$params['duration'] = $assesment->kb_start_time ?? '';                
				}
				$unit->medical_record_detail()->update($params);*/
            }
        });
    }

        
    public function setJumlahPemakaianPembalutAttribute($value) { 
        $this->attributes['jumlah_pemakaian_pembalut'] = $value ?? 0; 
    }

    
    public function setLongAttribute($value) {
        if($value == null) {
            $this->attributes['long'] = 0;
        } else {
            $this->attributes['long'] = $value;            
        }
    }

    public function setWeightAttribute($value) {
        if($value == null) {
            $this->attributes['weight'] = 0;
        } else {
            $this->attributes['weight'] = $value;            
        }
    }

    public function setBloodPressureAttribute($value) {
        if($value == null) {
            $this->attributes['blood_pressure'] = 0;
        } else {
            $this->attributes['blood_pressure'] = $value;            
        }
    }

    public function setPulseAttribute($value) {
        if($value == null) {
            $this->attributes['pulse'] = 0;
        } else {
            $this->attributes['pulse'] = $value;            
        }
    }


    public function setTemperatureAttribute($value) {
        if($value == null) {
            $this->attributes['temperature'] = 0;
        } else {
            $this->attributes['temperature'] = $value;            
        }
    }

    public function setBreathFrequencyAttribute($value) {
        if($value == null) {
            $this->attributes['breath_frequency'] = 0;
        } else {
            $this->attributes['breath_frequency'] = $value;            
        }
    }


    public function setBirthLongAttribute($value) {
        if($value == null) {
            $this->attributes['birth_long'] = 0;
        } else {
            $this->attributes['birth_long'] = $value;            
        }
    }


    public function setBirthWeightAttribute($value) {
        if($value == null) {
            $this->attributes['birth_weight'] = 0;
        } else {
            $this->attributes['birth_weight'] = $value;            
        }
    }

    public function setHeadSizeAttribute($value) {
        if($value == null) {
            $this->attributes['head_size'] = 0;
        } else {
            $this->attributes['head_size'] = $value;            
        }
    }

    public function setAdditionalAttribute($value) {
        $json = $value;
        $additional = $this->additional;
        foreach($json as $key => $unit) {
            $additional->{$key} = $unit;
        } 
        foreach($additional as $key => $unit) {
            $base_url = asset('files') . '/';
            $input = str_replace($base_url, '', $unit);
            $additional->{$key} = $input;
        } 
        $this->attributes['additional'] = json_encode($additional); 
    }

    public function setArmSizeAttribute($value) {
        if($value == null) {
            $this->attributes['arm_size'] = 0;
        } else {
            $this->attributes['arm_size'] = $value;            
        }
    }

    public function setBergulingUsiaAttribute($value) {
        if($value == null) {
            $this->attributes['berguling_usia'] = 0;
        } else {
            $this->attributes['berguling_usia'] = $value;            
        }
    }

    public function setDudukUsiaAttribute($value) {
        if($value == null) {
            $this->attributes['duduk_usia'] = 0;
        } else {
            $this->attributes['duduk_usia'] = $value;            
        }
    }


    public function setMerangkakUsiaAttribute($value) {
        if($value == null) {
            $this->attributes['merangkak_usia'] = 0;
        } else {
            $this->attributes['merangkak_usia'] = $value;            
        }
    }

    public function setMenarcheAgeAttribute($value) {
        if($value == null) {
            $this->attributes['menarche_age'] = 0;
        } else {
            $this->attributes['menarche_age'] = $value;            
        }
    }

    public function setSiklusHaidAttribute($value) {
        if($value == null) {
            $this->attributes['siklus_haid'] = 0;
        } else {
            $this->attributes['siklus_haid'] = $value;            
        }
    }

    public function setBerdiriUsiaAttribute($value) {
        if($value == null) {
            $this->attributes['berdiri_usia'] = 0;
        } else {
            $this->attributes['berdiri_usia'] = $value;            
        }
    }

    public function setBerjalanUsiaAttribute($value) {
        if($value == null) {
            $this->attributes['berjalan_usia'] = 0;
        } else {
            $this->attributes['berjalan_usia'] = $value;            
        }
    }

    public function setBicaraUsiaAttribute($value) {
        if($value == null) {
            $this->attributes['bicara_usia'] = 0;
        } else {
            $this->attributes['bicara_usia'] = $value;            
        }
    }

    public function setPrebirthWeightAttribute($value) {
        if($value == null) {
            $this->attributes['prebirth_weight'] = 0;
        } else {
            $this->attributes['prebirth_weight'] = $value;            
        }
    }

    public function setPostbirthWeightAttribute($value) {
        if($value == null) {
            $this->attributes['postbirth_weight'] = 0;
        } else {
            $this->attributes['postbirth_weight'] = $value;            
        }
    }


    public function patient() {
        return $this->belongsTo('App\Contact', 'patient_id', 'id')->whereIsPatient(1);
    }

    public function nurse() {
        return $this->belongsTo('App\User', 'updated_by', 'id');
    }

    public function disease_history() {
        return $this->hasMany('App\AssesmentDetail')->whereIsDiseaseHistory(1);
    }

    public function family_disease_history() {
        return $this->hasMany('App\AssesmentDetail')->whereIsFamilyDiseaseHistory(1);
    }

    public function pain_history() {
        return $this->hasMany('App\AssesmentDetail')->whereIsPainHistory(1);
    }

    public function pain_cure_history() {
        return $this->hasMany('App\AssesmentDetail')->whereIsPainCureHistory(1);
    }

    public function allergy_history() {
        return $this->hasMany('App\AssesmentDetail')->whereIsAllergyHistory(1);
    }

    public function kid_history() {
        return $this->hasMany('App\AssesmentDetail')->whereIsKidHistory(1);
    }

    public function imunisasi_history() {
        return $this->hasMany('App\AssesmentDetail')->whereIsImunisasiHistory(1);
    }

    public function getAdditionalAttribute() {
        if(array_key_exists('additional', $this->attributes)) {
            $additional = json_decode($this->attributes['additional']);
            return $additional;
        }
        return json_decode('{}');
    }
}
