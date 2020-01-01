<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Registration;
use App\RegistrationDetail;
use App\Assesment;
use App\MedicalRecord;
use DataTables;
use Auth;

class RegistrationApiController extends Controller
{
    public function registration(Request $request) {
        $x = Registration::with('medical_record', 'patient:id,name,phone')->select('registrations.id', 'registrations.code', 'registrations.medical_record_id', 'registrations.patient_id', 'registrations.date', 'registrations.status')
        ->whereBetween('registrations.date', [$request->date_start, $request->date_end]);

        if($request->filled('status')) {
            $x = $x->where('registrations.status', $request->status);
        }

        $x->orderBy('registrations.date', 'DESC')->orderBy('registrations.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function polyclinic_registered(Request $request, $flag = null) {
        $status = $flag == 'finish' ? 1 : 0;
        $x = RegistrationDetail::registered_polyclinic()
        ->with(
            'registration:id,code,patient_id,date',
            'medical_record:id,code,registration_id,registration_detail_id', 
            'registration.patient:id,name,phone,gender',
            'polyclinic:id,name',
            'doctor:id,name'
        )
        ->where('registration_details.status', $status)
        ->whereHas('registration', function(Builder $query) use($request){
            $query->whereBetween('date', [$request->date_start, $request->date_end])
            ->whereStatus(2);
        })
        ->select('registration_details.id', 'registration_id', 'registration_details.status', 'doctor_id', 'polyclinic_id');

        if($request->filled('status')) {
            $x = $x->where('registration_details.status', $request->status);
        }

        if($request->draw == 1)
            $x->orderBy('registration_details.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function radiology_registered(Request $request, $flag = null) {
        $status = $flag == 'finish' ? 1 : 0;
        $x = RegistrationDetail::registered_radiology()
        ->with(
            'registration:id,code,patient_id,date',
            'medical_record:id,code,registration_id,registration_detail_id', 
            'registration.patient:id,name,phone,gender',
            'polyclinic:id,name',
            'doctor:id,name'
        )
        ->where('registration_details.status', $status)
        ->whereHas('registration', function(Builder $query) use($request){
            $query->whereBetween('date', [$request->date_start, $request->date_end])
            ->whereStatus(2);
        })
        ->select('registration_details.id', 'registration_id', 'registration_details.status', 'doctor_id', 'polyclinic_id');

        if($request->filled('status')) {
            $x = $x->where('registration_details.status', $request->status);
        }

        if($request->draw == 1)
            $x->orderBy('registration_details.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }
    public function laboratory_registered(Request $request, $flag = null) {
        $status = $flag == 'finish' ? 1 : 0;
        $x = RegistrationDetail::registered_laboratory()
        ->with(
            'registration:id,code,patient_id,date',
            'medical_record:id,code,registration_id,registration_detail_id', 
            'registration.patient:id,name,phone,gender',
            'polyclinic:id,name',
            'doctor:id,name'
        )
        ->where('registration_details.status', $status)
        ->whereHas('registration', function(Builder $query) use($request){
            $query->whereBetween('date', [$request->date_start, $request->date_end])
            ->whereStatus(2);
        })
        ->select('registration_details.id', 'registration_id', 'registration_details.status', 'doctor_id', 'polyclinic_id');

        if($request->filled('status')) {
            $x = $x->where('registration_details.status', $request->status);
        }

        if($request->draw == 1)
            $x->orderBy('registration_details.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function chemoterapy_registered(Request $request, $flag = null) {
        $status = $flag == 'finish' ? 1 : 0;
        $x = RegistrationDetail::registered_chemoterapy()
        ->with(
            'registration:id,code,patient_id,date',
            'medical_record:id,code,registration_id,registration_detail_id', 
            'registration.patient:id,name,phone,gender',
            'polyclinic:id,name',
            'doctor:id,name'
        )
        ->where('registration_details.status', $status)
        ->whereHas('registration', function(Builder $query) use($request){
            $query->whereBetween('date', [$request->date_start, $request->date_end])
            ->whereStatus(2);
        })
        ->select('registration_details.id', 'registration_details.registration_id', 'registration_details.status', 'registration_details.doctor_id', 'registration_details.polyclinic_id');

        if($request->filled('status')) {
            $x = $x->where('registration_details.status', $request->status);
        }

        if($request->draw == 1)
            $x->orderBy('registration_details.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function ruang_tindakan_registered(Request $request, $flag = null) {
        $status = $flag == 'finish' ? 1 : 0;
        $x = RegistrationDetail::registered_ruang_tindakan()
        ->with(
            'registration:id,code,patient_id,date',
            'medical_record:id,code,registration_id,registration_detail_id', 
            'registration.patient:id,name,phone,gender',
            'polyclinic:id,name',
            'doctor:id,name'
        )
        ->where('registration_details.status', $status)
        ->whereHas('registration', function(Builder $query) use($request){
            $query->whereBetween('date', [$request->date_start, $request->date_end])
            ->whereStatus(2);
        })
        ->select('registration_details.id', 'registration_details.registration_id', 'registration_details.status', 'registration_details.doctor_id', 'registration_details.polyclinic_id');

        if($request->filled('status')) {
            $x = $x->where('registration_details.status', $request->status);
        }

        if($request->draw == 1)
            $x->orderBy('registration_details.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }
    public function medical_checkup_registered(Request $request, $flag = null) {
        $status = $flag == 'finish' ? 1 : 0;
        $x = RegistrationDetail::registered_medical_checkup()
        ->with(
            'registration:id,code,patient_id,date',
            'medical_record:id,code,registration_id,registration_detail_id', 
            'registration.patient:id,name,phone,gender',
            'polyclinic:id,name',
            'doctor:id,name'
        )
        ->where('registration_details.status', $status)
        ->whereHas('registration', function(Builder $query) use($request){
            $query->whereBetween('date', [$request->date_start, $request->date_end])
            ->whereStatus(2);
        })
        ->select('registration_details.id', 'registration_details.registration_id', 'registration_details.status', 'registration_details.doctor_id', 'registration_details.polyclinic_id');

        if($request->filled('status')) {
            $x = $x->where('registration_details.status', $request->status);
        }

        if($request->draw == 1)
            $x->orderBy('registration_details.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function medical_record(Request $request) {
        $x = MedicalRecord::with('registration_detail:id,doctor_id', 
            'registration_detail.doctor:id,name,specialization_id',
            'registration_detail.doctor.specialization:id,name',
            'patient:id,name,age,birth_date,gender,city_id,phone,address',
            'patient.city:id,name'
        )
        ->select('medical_records.id','medical_records.patient_id','medical_records.code', 'registration_detail_id');

        if($request->draw == 1)
            $x->orderBy('medical_records.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function polyclinic_medical_record(Request $request, $patient_id) {
        $x = RegistrationDetail::registered_polyclinic()
        ->has('registration.invoice')
        ->has('medical_record')
        ->orHas('medical_record_refer')
        ->with('doctor:id,name', 
            'medical_record:id,registration_detail_id,code,main_complaint,date',
            'medical_record_refer:id,registration_detail_id,code,main_complaint,date',
            'registration:id',
            'registration.invoice:id,registrati1on_id,status'
        )
        ->whereHas('registration', function(Builder $query) use($request, $patient_id){
            $query->wherePatientId($patient_id);
        })
        ->select('registration_details.id', 'doctor_id', 'registration_details.registration_id', 'registration_details.medical_record_refer_id');

        if(Auth::user()->is_admin != 1) {
            if(Auth::user()->doctor) {
                $x->whereDoctorId(Auth::user()->contact_id);
            }
        }
        // $x = MedicalRecord::has('registration_detail.registration.invoice')
        // ->with('registration_detail:id,registration_id,doctor_id', 'registration_detail.doctor:id,name', 'registration_detail.registration:id', 'registration_detail.registration.invoice:registration_id,status')
        // ->wherePatientId($patient_id)
        // ->select('id', 'patient_id', 'code', 'date', 'main_complaint', 'updated_by', 'registration_detail_id')
        // ->whereHas('registration_detail', function(Builder $query) use($request){
        //     $query->whereDestination('POLIKLINIK');
        // })
        // ->whereBetween('medical_records.date', [$request->date_start, $request->date_end]);

        // if($request->filled('current_id'))
        //     $x->where('id', '!=', $request->current_id);

        if($request->draw == 1)
            $x->orderBy('registration_details.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function radiology_medical_record(Request $request, $patient_id) {
        $x = RegistrationDetail::registered_radiology()
        ->has('registration.invoice')
        ->has('medical_record')
        ->orHas('medical_record_refer')
        ->with('doctor:id,name', 
            'medical_record:id,registration_detail_id,code,main_complaint,date',
            'medical_record_refer:id,registration_detail_id,code,main_complaint,date',
            'registration:id',
            'registration.invoice:id,registration_id,status'
        )
        ->whereHas('registration', function(Builder $query) use($request, $patient_id){
            $query->wherePatientId($patient_id);
        })
        ->select('registration_details.id', 'doctor_id', 'registration_details.registration_id', 'registration_details.medical_record_refer_id');

        if(Auth::user()->is_admin != 1) {
            if(Auth::user()->doctor) {
                $x->whereDoctorId(Auth::user()->contact_id);
            }
        }
        // $x = MedicalRecord::has('registration_detail.registration.invoice')
        // ->with('registration_detail:id,registration_id,doctor_id', 'registration_detail.doctor:id,name', 'registration_detail.registration:id', 'registration_detail.registration.invoice:registration_id,status')
        // ->wherePatientId($patient_id)
        // ->select('id', 'patient_id', 'code', 'date', 'main_complaint', 'updated_by', 'registration_detail_id')
        // ->whereHas('registration_detail', function(Builder $query) use($request){
        //     $query->whereDestination('POLIKLINIK');
        // })
        // ->whereBetween('medical_records.date', [$request->date_start, $request->date_end]);

        // if($request->filled('current_id'))
        //     $x->where('id', '!=', $request->current_id);

        if($request->draw == 1)
            $x->orderBy('registration_details.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }
    public function laboratory_medical_record(Request $request, $patient_id) {
        $x = RegistrationDetail::registered_laboratory()
        ->has('registration.invoice')
        ->has('medical_record')
        ->orHas('medical_record_refer')
        ->with('doctor:id,name', 
            'medical_record:id,registration_detail_id,code,main_complaint,date',
            'medical_record_refer:id,registration_detail_id,code,main_complaint,date',
            'registration:id',
            'registration.invoice:id,registration_id,status'
        )
        ->whereHas('registration', function(Builder $query) use($request, $patient_id){
            $query->wherePatientId($patient_id);
        })
        ->select('registration_details.id', 'doctor_id', 'registration_details.registration_id', 'registration_details.medical_record_refer_id');

        if(Auth::user()->is_admin != 1) {
            if(Auth::user()->doctor) {
                $x->whereDoctorId(Auth::user()->contact_id);
            }
        }
        // $x = MedicalRecord::has('registration_detail.registration.invoice')
        // ->with('registration_detail:id,registration_id,doctor_id', 'registration_detail.doctor:id,name', 'registration_detail.registration:id', 'registration_detail.registration.invoice:registration_id,status')
        // ->wherePatientId($patient_id)
        // ->select('id', 'patient_id', 'code', 'date', 'main_complaint', 'updated_by', 'registration_detail_id')
        // ->whereHas('registration_detail', function(Builder $query) use($request){
        //     $query->whereDestination('POLIKLINIK');
        // })
        // ->whereBetween('medical_records.date', [$request->date_start, $request->date_end]);

        // if($request->filled('current_id'))
        //     $x->where('id', '!=', $request->current_id);

        if($request->draw == 1)
            $x->orderBy('registration_details.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function chemoterapy_medical_record(Request $request, $patient_id) {
        $x = RegistrationDetail::registered_chemoterapy()
        ->has('registration.invoice')
        ->has('medical_record')
        // ->orHas('medical_record_refer')
        ->with('doctor:id,name', 
            'medical_record:id,registration_detail_id,code,main_complaint,date,patient_id',
            'medical_record_refer:id,registration_detail_id,code,main_complaint,date',
            'registration:id,patient_id',
            'registration.invoice:id,registration_id,status'
        )
        ->whereHas('medical_record', function(Builder $query) use($request, $patient_id){
            $query->wherePatientId($patient_id);
        })
        ->orWhereHas('medical_record_refer', function(Builder $query) use($request, $patient_id){
            $query->wherePatientId($patient_id);
        })
        ->select('registration_details.id', 'doctor_id', 'registration_details.registration_id', 'registration_details.medical_record_refer_id');

        $contact = Auth::user()->contact;
        if(Auth::user()->is_admin != 1 && $contact) {
            if($contact->is_doctor == 1) {
                $x->whereDoctorId(Auth::user()->contact_id);
            }
        }
        // $x = MedicalRecord::has('registration_detail.registration.invoice')
        // ->with('registration_detail:id,registration_id,doctor_id', 'registration_detail.doctor:id,name', 'registration_detail.registration:id', 'registration_detail.registration.invoice:registration_id,status')
        // ->wherePatientId($patient_id)
        // ->select('id', 'patient_id', 'code', 'date', 'main_complaint', 'updated_by', 'registration_detail_id')
        // ->whereHas('registration_detail', function(Builder $query) use($request){
        //     $query->whereDestination('POLIKLINIK');
        // })
        // ->whereBetween('medical_records.date', [$request->date_start, $request->date_end]);

        // if($request->filled('current_id'))
        //     $x->where('id', '!=', $request->current_id);

        if($request->draw == 1)
            $x->orderBy('registration_details.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function ruang_tindakan_medical_record(Request $request, $patient_id) {
        $x = RegistrationDetail::registered_ruang_tindakan()
        ->has('registration.invoice')
        ->has('medical_record')
        ->orHas('medical_record_refer')
        ->with('doctor:id,name', 
            'medical_record:id,registration_detail_id,code,main_complaint,date',
            'medical_record_refer:id,registration_detail_id,code,main_complaint,date',
            'registration:id',
            'registration.invoice:id,registration_id,status'
        )
        ->whereHas('registration', function(Builder $query) use($request, $patient_id){
            $query->wherePatientId($patient_id);
        })
        ->select('registration_details.id', 'doctor_id', 'registration_details.registration_id', 'registration_details.medical_record_refer_id');

        if(Auth::user()->is_admin != 1) {
            if(Auth::user()->doctor) {
                $x->whereDoctorId(Auth::user()->contact_id);
            }
        }
        // $x = MedicalRecord::has('registration_detail.registration.invoice')
        // ->with('registration_detail:id,registration_id,doctor_id', 'registration_detail.doctor:id,name', 'registration_detail.registration:id', 'registration_detail.registration.invoice:registration_id,status')
        // ->wherePatientId($patient_id)
        // ->select('id', 'patient_id', 'code', 'date', 'main_complaint', 'updated_by', 'registration_detail_id')
        // ->whereHas('registration_detail', function(Builder $query) use($request){
        //     $query->whereDestination('POLIKLINIK');
        // })
        // ->whereBetween('medical_records.date', [$request->date_start, $request->date_end]);

        // if($request->filled('current_id'))
        //     $x->where('id', '!=', $request->current_id);

        if($request->draw == 1)
            $x->orderBy('registration_details.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }
    public function medical_checkup_medical_record(Request $request, $patient_id) {
        $x = RegistrationDetail::registered_medical_checkup()
        ->has('registration.invoice')
        ->has('medical_record')
        ->orHas('medical_record_refer')
        ->with('doctor:id,name', 
            'medical_record:id,registration_detail_id,code,main_complaint,date',
            'medical_record_refer:id,registration_detail_id,code,main_complaint,date',
            'registration:id',
            'registration.invoice:id,registration_id,status'
        )
        ->whereHas('registration', function(Builder $query) use($request, $patient_id){
            $query->wherePatientId($patient_id);
        })
        ->select('registration_details.id', 'doctor_id', 'registration_details.registration_id', 'registration_details.medical_record_refer_id');

        if(Auth::user()->is_admin != 1) {
            if(Auth::user()->doctor) {
                $x->whereDoctorId(Auth::user()->contact_id);
            }
        }
        // $x = MedicalRecord::has('registration_detail.registration.invoice')
        // ->with('registration_detail:id,registration_id,doctor_id', 'registration_detail.doctor:id,name', 'registration_detail.registration:id', 'registration_detail.registration.invoice:registration_id,status')
        // ->wherePatientId($patient_id)
        // ->select('id', 'patient_id', 'code', 'date', 'main_complaint', 'updated_by', 'registration_detail_id')
        // ->whereHas('registration_detail', function(Builder $query) use($request){
        //     $query->whereDestination('POLIKLINIK');
        // })
        // ->whereBetween('medical_records.date', [$request->date_start, $request->date_end]);

        // if($request->filled('current_id'))
        //     $x->where('id', '!=', $request->current_id);

        if($request->draw == 1)
            $x->orderBy('registration_details.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }



    public function assesment(Request $request, $patient_id) {
        $x = Assesment::with('nurse:id,name')->wherePatientId($patient_id)->select('id', 'patient_id', 'date', 'main_complaint', 'updated_by')
        ->whereBetween('assesments.date', [$request->date_start, $request->date_end]);

        if($request->filled('current_id'))
            $x->where('id', '!=', $request->current_id);

        if($request->draw == 1)
            $x->orderBy('assesments.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

}
