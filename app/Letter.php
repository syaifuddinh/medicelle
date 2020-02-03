<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use App\MedicalRecord;

class Letter extends Model
{
    protected $fillable = ['code', 'medical_record_id', 'doctor_id', 'date', 'review_date', 'start_date', 'end_date', 'duration', 'duration_type', 'age', 'age_type', 'description', 'option', 'additional'];
    protected $appends = ['additional'];

    public static function boot() {
        parent::boot();

        static::creating(function(Letter $letter){
            $letter->created_by = Auth::user()->id;
            $letter->doctor_id = MedicalRecord::find($letter->medical_record_id)->registration_detail->doctor_id;
            if($letter->is_cuti_hamil == 1) {
                $current_month = date('m');
                $current_year = date('Y');
                $id = DB::table('letters')
                ->whereRaw("TO_CHAR(date::DATE, 'mm') = '$current_month' AND TO_CHAR(date::DATE, 'YYYY') = '$current_year' AND is_cuti_hamil = 1")
                ->count('id') + 1;
                $id = $id == null ? 1 : $id;
                $id = str_pad($id, 3, '0', STR_PAD_LEFT);
                $code = $id . '/SCH/MDC/' . date('m') . '/' . date('Y');

                $letter->code = $code;
            } else if($letter->is_keterangan_dokter == 1) {
                $current_month = date('m');
                $current_year = date('Y');
                $id = DB::table('letters')
                ->whereRaw("TO_CHAR(date::DATE, 'mm') = '$current_month' AND TO_CHAR(date::DATE, 'YYYY') = '$current_year' AND is_keterangan_dokter = 1")
                ->count('id') + 1;
                $id = $id == null ? 1 : $id;
                $id = str_pad($id, 3, '0', STR_PAD_LEFT);
                $code = $id . '/SKD/MDC/' . date('m') . '/' . date('Y');

                $letter->code = $code;
            } else if($letter->is_keterangan_sehat == 1) {
                $current_month = date('m');
                $current_year = date('Y');
                $id = DB::table('letters')
                ->whereRaw("TO_CHAR(date::DATE, 'mm') = '$current_month' AND TO_CHAR(date::DATE, 'YYYY') = '$current_year' AND is_keterangan_sehat = 1")
                ->count('id') + 1;
                $id = $id == null ? 1 : $id;
                $id = str_pad($id, 3, '0', STR_PAD_LEFT);
                $code = $id . '/MDC/' . date('m') . '/' . date('Y');

                $letter->code = $code;
            } else if($letter->is_layak_terbang == 1) {
                $current_month = date('m');
                $current_year = date('Y');
                $id = DB::table('letters')
                ->whereRaw("TO_CHAR(date::DATE, 'mm') = '$current_month' AND TO_CHAR(date::DATE, 'YYYY') = '$current_year' AND is_layak_terbang = 1")
                ->count('id') + 1;
                $id = $id == null ? 1 : $id;
                $id = str_pad($id, 3, '0', STR_PAD_LEFT);
                $code = $id . '/SLT/MDC/' . date('m') . '/' . date('Y');

                $letter->code = $code;
            } else if($letter->is_pengantar_mrs == 1) {
                $current_month = date('m');
                $current_year = date('Y');
                $id = DB::table('letters')
                ->whereRaw("TO_CHAR(date::DATE, 'mm') = '$current_month' AND TO_CHAR(date::DATE, 'YYYY') = '$current_year' AND is_pengantar_mrs = 1")
                ->count('id') + 1;
                $id = $id == null ? 1 : $id;
                $id = str_pad($id, 3, '0', STR_PAD_LEFT);
                $code = $id . '/MRS/MDC/' . date('m') . '/' . date('Y');

                $letter->code = $code;
            } else if($letter->is_rujukan_pasien == 1) {
                $current_month = date('m');
                $current_year = date('Y');
                $id = DB::table('letters')
                ->whereRaw("TO_CHAR(date::DATE, 'mm') = '$current_month' AND TO_CHAR(date::DATE, 'YYYY') = '$current_year' AND is_rujukan_pasien = 1")
                ->count('id') + 1;
                $id = $id == null ? 1 : $id;
                $id = str_pad($id, 3, '0', STR_PAD_LEFT);
                $code = $id . '/PRJ/MDC/' . date('m') . '/' . date('Y');

                $letter->code = $code;
            } else if($letter->is_persetujuan_tindakan_medis == 1) {
                $current_month = date('m');
                $current_year = date('Y');
                $id = DB::table('letters')
                ->whereRaw("TO_CHAR(date::DATE, 'mm') = '$current_month' AND TO_CHAR(date::DATE, 'YYYY') = '$current_year' AND is_rujukan_pasien = 1")
                ->count('id') + 1;
                $id = $id == null ? 1 : $id;
                $id = str_pad($id, 3, '0', STR_PAD_LEFT);
                $code = $id . '/SPM/MDC/' . date('m') . '/' . date('Y');

                $letter->code = $code;
            }
        });

        static::updating(function(Letter $letter){
            $letter->updated_by = Auth::user()->id;
            $letter->doctor_id = MedicalRecord::find($letter->medical_record_id)->registration_detail->doctor_id;
        });
    }

    public function getAdditionalAttribute() {
        if(array_key_exists('additional', $this->attributes)) {
            $additional = json_decode($this->attributes['additional']);
            return $additional;
        }
        return json_decode('{}');
    }

    public function setAdditionalAttribute($value) {
        $this->attributes['additional'] = json_encode($value);    
    }

    public function medical_record() {
        return $this->belongsTo('App\MedicalRecord');
    }
    public function doctor() {
        return $this->belongsTo('App\Contact', 'doctor_id', 'id');
    }
}
