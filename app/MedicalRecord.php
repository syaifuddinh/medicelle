<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RegistrationDetail;
use Auth;
use DB;

class MedicalRecord extends Model
{
    protected $appends = ['additional'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['code', 'patient_id', 'current_disease','obgyn_current_disease','psiko_sosial','operasi','obgyn_operasi', 'step', 'main_complaint', 'obgyn_main_complaint', 'is_disturb', 'pain_score', 'fallen', 'fallen_description', 'secondary_diagnose', 'secondary_diagnose_description', 'helper', 'helper_description', 'infus', 'infus_description', 'walking', 'walking_description', 'mental', 'mental_description', 'menarche_age','siklus_haid','jumlah_pemakaian_pembalut','lama_pemakaian_pembalut','is_tidy','hpht','haid_complaint','marriage_status','marriage_duration','is_pernah_kb','kb_item','kb_start_time','kb_complaint','gravida','partus','abortus','imunisasi_tt','pada_usia_kehamilan','pemakaian_obat_saat_kehamilan','keluhan_saat_kehamilan', 'general_condition','gigi_tumbuh_pertama','long','weight','blood_pressure','pulse','temperature','breath_frequency','prebirth_weight','postbirth_weight','birth_long','birth_weight','head_size','arm_size','berguling_usia','duduk_usia','merangkak_usia','berdiri_usia','berjalan_usia','bicara_usia', 'ekg', 'usg', 'head_description','rectum_description','breast_description', 'physique', 'reduksi', 'registration_id', 'additional'];


    public static function boot() {
        parent::boot();
        static::creating(function(MedicalRecord $medicalRecord) {
            $medicalRecord->date = date('Y-m-d');
            $medicalRecord->created_by = Auth::user()->id;
            // Generate medical record code
            $existingMedicalRecord = MedicalRecord::wherePatientId($medicalRecord->patient_id)->select('code')->first();
            if($existingMedicalRecord != null) {
                $medicalRecord->code = $existingMedicalRecord->code;
            } else {
                
                $current_month = date('m');
                $current_year = date('Y');
                $latest = DB::table('medical_records')
                ->whereRegistrationId($medicalRecord->registration_id)
                ->whereRaw("TO_CHAR(date :: DATE, 'mm') = '$current_month'  AND TO_CHAR(date::DATE, 'YYYY') = '$current_year'")
                ->selectRaw('COALESCE(COUNT(id), 0) + 1 AS new_id')
                ->first();
                $id = $latest->new_id;
                if($id < 2) {
                    $newest = DB::table('medical_records')
                    ->whereRaw("TO_CHAR(date :: DATE, 'mm') = '$current_month' AND TO_CHAR(date::DATE, 'YYYY') = '$current_year'")
                    ->selectRaw('COALESCE(COUNT(DISTINCT code), 0) + 1 AS new_id')
                    ->first();
                    $id = $newest->new_id;
                    $id = str_pad($id, 4, '0', STR_PAD_LEFT);
                    $code = date('y.m.') . $id;
                } else {
                    $latest = DB::table('medical_records')
                    ->whereRegistrationId($medicalRecord->registration_id)
                    ->select('code')
                    ->first();
                    $code = $latest->code;
                }

                $medicalRecord->code = $code; 
            }
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
            $medicalRecord->risk_level = $medicalRecord->fallen + $medicalRecord->secondary_diagnose + $medicalRecord->helper + $medicalRecord->infus + $medicalRecord->walking + $medicalRecord->mental;
            $risk_level_status = '';
            $risk_level_action = '';
            if($medicalRecord->risk_level >=0 && $medicalRecord->risk_level <= 24) {
                  $risk_level_status = 'Tidak beresiko';
                  $risk_level_description = 'Perawatan dasar';
             } else if($medicalRecord->risk_level >=25 && $medicalRecord->risk_level <= 50) {
                  $risk_level_status = 'Resiko rendah';
                  $risk_level_description = 'Pelaksanaan intervensi pencegahan jatuh standard';
             } else if($medicalRecord->risk_level > 50) {
                  $risk_level_status = 'Resiko tinggi';
                  $risk_level_description = 'Pelaksanaan intervensi pencegahan jatuh standard';
             }

              $medicalRecord->risk_level_status = $risk_level_status;
              $medicalRecord->risk_level_description = $risk_level_description;

              // Rujukan dokter
              if($medicalRecord->refer_doctor_id != null) {
                    $latestRefer = RegistrationDetail::whereMedicalRecordReferId($medicalRecord->id)
                    ->first();
                    if($latestRefer == null) {
                        $registrationDetail = new RegistrationDetail();
                        $registrationDetail->fill($medicalRecord->registration_detail->toArray());
                        $registrationDetail->medical_record_refer_id = $medicalRecord->id;
                        $registrationDetail->doctor_id = $medicalRecord->refer_doctor_id;
                        $registrationDetail->save();
                        $registrationDetail->pivot_medical_record()->create([
                            'medical_record_id' => $medicalRecord->id
                        ]);
                    } else {
                        $latestRefer->update([
                            'doctor_id' => $medicalRecord->refer_doctor_id
                        ]);
                    }
              }
        });
    }


    public function getAdditionalAttribute() {
        if(array_key_exists('additional', $this->attributes)) {
            $additional = json_decode($this->attributes['additional']);
            if(null != ($additional->head_visual ?? null)) {
                $additional->head_visual = asset('files/' . $additional->head_visual);
            }
            if(null != ($additional->general_visual ?? null)) {
                $additional->general_visual = asset('files/' . $additional->general_visual);
            }
            if(null != ($additional->surgical_visual ?? null)) {
                $additional->surgical_visual = asset('files/' . $additional->surgical_visual);
            }
            if(null != ($additional->rectum_visual ?? null)) {
                $additional->rectum_visual = asset('files/' . $additional->rectum_visual);
            }
            if(null != ($additional->breast_visual ?? null)) {
                $additional->breast_visual = asset('files/' . $additional->breast_visual);
            }
            if(null != ($additional->fnab_visual ?? null)) {
                $additional->fnab_visual = asset('files/' . $additional->fnab_visual);
            }
            return $additional;
        }
        return json_decode('{}');
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

    public function setLongAttribute($value) { 
        $this->attributes['long'] = $value ?? 0; 
    }

    public function setWeightAttribute($value) { 
        $this->attributes['weight'] = $value ?? 0; 
    }

    public function setPulseAttribute($value) { 
        $this->attributes['pulse'] = $value ?? 0; 
    }

    public function setTemperatureAttribute($value) { 
        $this->attributes['temperature'] = $value ?? 0; 
    }

    public function setBloodPressureAttribute($value) { 
        $this->attributes['blood_pressure'] = $value ?? 0; 
    }

    public function setBreathFrequencyAttribute($value) { 
        $this->attributes['breath_frequency'] = $value ?? 0; 
    }

    public function setMenarcheAgeAttribute($value) { 
        $this->attributes['menarche_age'] = $value ?? 0; 
    }
    public function setJumlahPemakaianPembalutAttribute($value) { 
        $this->attributes['jumlah_pemakaian_pembalut'] = $value ?? 0; 
    }


    public function patient() {
        return $this->belongsTo('App\Contact', 'patient_id', 'id')->whereIsPatient(1);
    }

    public function refer_doctor() {
        return $this->belongsTo('App\Contact', 'refer_doctor_id', 'id')->whereIsDoctor(1);
    }

    public function registration_detail() {
        return $this->belongsTo('App\RegistrationDetail');
    }


    public function registration() {
        return $this->belongsTo('App\Registration');
    }

    public function disease_history() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsDiseaseHistory(1);
    }


    public function diagnose_history() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsDiagnoseHistory(1);
    }


    public function obgyn_disease_history() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsObgynDiseaseHistory(1);
    }

    public function family_disease_history() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsFamilyDiseaseHistory(1);
    }

    public function obgyn_family_disease_history() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsObgynFamilyDiseaseHistory(1);
    }

    public function ginekologi_history() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsGinekologiHistory(1);
    }

    public function kb_history() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsKbHistory(1);
    }

    public function treatment() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsTreatment(1);
    }

    public function treatment_group() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsTreatmentGroup(1);
    }

    public function diagnostic() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsDiagnostic(1);
    }

    public function drug() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsDrug(1);
    }

    public function radiology() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsRadiology(1);
    }

    public function bhp() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsBhp(1);
    }

    public function sewa_ruangan() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsSewaRuangan(1);
    }


    public function sewa_alkes() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsSewaAlkes(1);
    }

    public function next_schedule() {
        return $this->hasOne('App\MedicalRecordDetail')->whereIsSchedule(1)->where('date', '>', date('Y-m-d'))->orderBy('date', 'ASC')->withDefault(['date' => '']);
    }

    public function schedule() {
        return $this->hasOne('App\MedicalRecordDetail')->whereIsSchedule(1);
    }

    public function laboratory() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsLaboratory(1);
    }

    public function pathology() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsPathology(1);
    }

    public function komplikasi_kb_history() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsKomplikasiKbHistory(1);
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

    public function kid_history() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsKidHistory(1);
    }

    public function imunisasi_history() {
        return $this->hasMany('App\MedicalRecordDetail')->whereIsImunisasiHistory(1);
    }
}
