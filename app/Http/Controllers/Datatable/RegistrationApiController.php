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

class RegistrationApiController extends Controller
{
    public function registration(Request $request) {
        $x = Registration::with('medical_record', 'patient:id,name,phone')->select('registrations.id', 'registrations.code', 'medical_record_id', 'registrations.patient_id', 'registrations.date', 'registrations.status')
        ->whereBetween('registrations.date', [$request->date_start, $request->date_end]);

        if($request->filled('status')) {
            $x = $x->where('registrations.status', $request->status);
        }

        if($request->draw == 1)
            $x->orderBy('registrations.id', 'DESC');

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
            $query->whereBetween('date', [$request->date_start, $request->date_end]);
        })
        ->select('registration_details.id', 'registration_id', 'registration_details.status', 'doctor_id', 'polyclinic_id');

        if($request->filled('status')) {
            $x = $x->where('registration_details.status', $request->status);
        }

        if($request->draw == 1)
            $x->orderBy('registration_details.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function polyclinic_medical_record(Request $request, $patient_id) {
        $x = MedicalRecord::has('registration_detail.registration.invoice')
        ->with('registration_detail:id,registration_id,doctor_id', 'registration_detail.doctor:id,name', 'registration_detail.registration:id', 'registration_detail.registration.invoice:registration_id,status')
        ->wherePatientId($patient_id)
        ->select('id', 'patient_id', 'code', 'date', 'main_complaint', 'updated_by', 'registration_detail_id')
        ->whereHas('registration_detail', function(Builder $query) use($request){
            $query->whereDestination('POLIKLINIK');
        })
        ->whereBetween('medical_records.date', [$request->date_start, $request->date_end]);

        if($request->filled('current_id'))
            $x->where('id', '!=', $request->current_id);

        if($request->draw == 1)
            $x->orderBy('medical_records.id', 'DESC');

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
