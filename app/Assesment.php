<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Assesment extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['step', 'date', 'registration_id', 'patient_id', 'created_by', 'updated_by', 'is_disturb','pain_score','pain_description','fallen','fallen_description','secondary_diagnose','secondary_diagnose_description','helper','helper_description','infus','infus_description','walking','walking_description','mental','mental_description','risk_level','risk_level_status','risk_level_description','menarche_age','siklus_haid','jumlah_pemakaian_pembalut','lama_pemakaian_pembalut','is_tidy','hpht','haid_complaint','marriage_status','marriage_duration','is_pernah_kb','kb_item','kb_start_time','kb_complaint','gravida','partus','abortus','imunisasi_tt','pada_usia_kehamilan','pemakaian_obat_saat_kehamilan','keluhan_saat_kehamilan','general_condition','gigi_tumbuh_pertama','long','weight','blood_pressure','pulse','temperature','breath_frequency','prebirth_weight','postbirth_weight','birth_long','birth_weight','head_size','arm_size','berguling_usia','duduk_usia','merangkak_usia','berdiri_usia','berjalan_usia','bicara_usia'];

    public static function boot() {
        parent::boot();

        static::creating(function(Assesment $assesment){
            $assesment->date = date('Y-m-d');
            $assesment->created_by = Auth::user()->id;
        });

        static::updating(function(Assesment $assesment){
            $assesment->updated_by = Auth::user()->id;
        });
    }


    public function patient() {
        return $this->belongsTo('App\Contact', 'patient_id', 'id')->whereIsPatient(1);
    }

    public function nurse() {
        return $this->belongsTo('App\User', 'updated_by', 'id')->whereIsNurse(1)->orWhere('is_nurse_helper', 1);
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
}
