<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class MedicalRecord extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['code', 'medical_record_id', 'patient_id', 'step', 'main_complaint', 'is_disturb', 'pain_score', 'fallen', 'fallen_description', 'secondary_diagnose', 'secondary_diagnose_description', 'helper', 'helper_description', 'infus', 'infus_description', 'walking', 'walking_description', 'mental', 'mental_description'];
    public static function boot() {
        parent::boot();
        static::creating(function(MedicalRecord $medicalRecord) {
            $medicalRecord->date = date('Y-m-d');
            $medicalRecord->created_by = Auth::user()->id;
            // Generate medical record code
            $id = DB::table('medical_records')->count('id') + 1;
            $id = $id == null ? 1 : $id;
            $id = str_pad($id, 4, '0', STR_PAD_LEFT);
            $code = date('y.m.') . $id;

            $medicalRecord->code = $code; 
        });

        static::updating(function(MedicalRecord $medicalRecord) {
            $medicalRecord->updated_by = Auth::user()->id;
            $description = '-';
            switch($medicalRecord->pain_score) {
                case 0 :
                    $description = 'Tidak ada rasa nyeri / normal';
                    break;
                case 1 :
                    $description = 'Nyeri seperti gatal gigitan nyamuk';
                    break;
                case 2 :
                    $description = 'Terasa nyeri seperti dicubit/melilit';
                    break;
                case 3 :
                    $description = 'Nyeri sangat terasa seperti ditonjok bagian wajah atau disuntik';
                    break;
                case 4 :
                    $description = 'Nyeri yang kuat seperti sakit gigi dan nyeri disengat tawon';
                    break;
                case 5 :
                    $description = 'Nyeri yang tertekan seperti terkilir, keseleo';
                    break;
                case 6 :
                    $description = 'Nyeri yang seperti tertusuk-tusuk menyebabkan tidak fokus dan komunikasi terganggu';
                    break;
                case 7 :
                    $description = 'Nyeri yang menusuk begitu kuat menyebabkan tidak bisa berkomunikasi dengan baik dan tidak mampu melakukan perawatan sendiri';
                    break;
                case 8 :
                    $description = 'Nyeri yang begitu kuat sehingga menyebabkan tidak dapat berfikir jernih';
                    break;
                case 9 :
                    $description = 'Nyeri yang menyiksa tak tertahankan sehingga ingin segera menghilangkan nyerinya';
                    break;
                case 10 :
                    $description = 'Nyeri yang tidak terbayangkan dan tidak dapat diungkapkan sampai tidak sadarkan diri';
                    break;
            }

            $medicalRecord->pain_description = $description;
        });
    }

    public function patient() {
        return $this->belongsTo('App\Contact', 'patient_id', 'id')->whereIsPatient(1);
    }

    public function disease_history() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsDiseaseHistory(1);
    }

    public function family_disease_history() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsFamilyDiseaseHistory(1);
    }

    public function pain_history() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsPainHistory(1);
    }

    public function pain_cure_history() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsPainCureHistory(1);
    }

    public function allergy_history() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsAllergyHistory(1);
    }
}
