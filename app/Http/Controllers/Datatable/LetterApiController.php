<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Specialization;
use App\Letter;
use DataTables;

class LetterApiController extends Controller
{
    public function cuti_hamil(Request $request) {
        $x = Letter::with('doctor:id,name,specialization_id','doctor.specialization:id,name', 'medical_record:id,code,patient_id', 'medical_record.patient:id,name,address')
        ->whereIsCutiHamil(1)
        ->select('letters.id', 'letters.code', 'doctor_id', 'medical_record_id');

        return Datatables::eloquent($x)->make(true);
           
    }

    public function keterangan_dokter(Request $request) {
        $x = Letter::with('doctor:id,name,specialization_id','doctor.specialization:id,name', 'medical_record:id,code,patient_id', 'medical_record.patient:id,name,address')
        ->whereIsKeteranganDokter(1)
        ->select('letters.id', 'letters.code', 'doctor_id', 'medical_record_id');
        
        if($request->order[0]['column'] == 0) {
            $x->orderBy('letters.id', $request->order[0]['dir']);
        }

        return Datatables::eloquent($x)->make(true);
           
    }
    
    public function keterangan_sehat(Request $request) {
        $x = Letter::with('doctor:id,name,specialization_id','doctor.specialization:id,name', 'medical_record:id,code,patient_id', 'medical_record.patient:id,name,address')
        ->whereIsKeteranganSehat(1)
        ->select('letters.id', 'letters.code', 'doctor_id', 'medical_record_id');

        if($request->order[0]['column'] == 0) {
            $x->orderBy('letters.id', $request->order[0]['dir']);
        }


        return Datatables::eloquent($x)->make(true);
           
    }
    
    public function layak_terbang(Request $request) {
        $x = Letter::with('doctor:id,name,specialization_id','doctor.specialization:id,name', 'medical_record:id,code,patient_id', 'medical_record.patient:id,name,address')
        ->whereIsLayakTerbang(1)
        ->select('letters.id', 'letters.code', 'letters.doctor_id', 'letters.medical_record_id');

        if($request->order[0]['column'] == 0) {
            $x->orderBy('letters.id', $request->order[0]['dir']);
        }


        return Datatables::eloquent($x)->make(true);   
    }

    public function pengantar_mrs(Request $request) {
        $x = Letter::with('doctor:id,name,specialization_id','doctor.specialization:id,name', 'medical_record:id,code,patient_id', 'medical_record.patient:id,name,address')
        ->whereIsPengantarMrs(1)
        ->select('letters.id', 'letters.code', 'doctor_id', 'medical_record_id');

        if($request->order[0]['column'] == 0) {
            $x->orderBy('letters.id', $request->order[0]['dir']);
        }


        return Datatables::eloquent($x)->make(true);
           
    }

    public function rujukan_pasien(Request $request) {
        $x = Letter::with('doctor:id,name,specialization_id','doctor.specialization:id,name', 'medical_record:id,code,patient_id', 'medical_record.patient:id,name,address')
        ->whereIsRujukanPasien(1)
        ->select('letters.id', 'letters.code', 'doctor_id', 'medical_record_id');

        if($request->order[0]['column'] == 0) {
            $x->orderBy('letters.id', $request->order[0]['dir']);
        }


        return Datatables::eloquent($x)->make(true);
           
    }
    
    public function persetujuan_tindakan_medis(Request $request) {
        $x = Letter::with('doctor:id,name,specialization_id','doctor.specialization:id,name', 'medical_record:id,code,patient_id', 'medical_record.patient:id,name,address')
        ->whereIsPersetujuanTindakanMedis(1)
        ->select('letters.id', 'letters.code', 'doctor_id', 'medical_record_id');

        if($request->order[0]['column'] == 0) {
            $x->orderBy('letters.id', $request->order[0]['dir']);
        }


        return Datatables::eloquent($x)->make(true);
           
    }
}
