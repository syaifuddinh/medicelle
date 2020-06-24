<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Registration;
use App\RegistrationDetail;
use App\PivotMedicalRecord;
use App\Assesment;
use App\MedicalRecord;
use DataTables;
use Auth;
use DB;

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
        $x = PivotMedicalRecord::with(
            'registration_detail:id,registration_id,doctor_id,polyclinic_id',
            'registration_detail.registration:id,code,patient_id,date',
            'medical_record:id,code,registration_id,registration_detail_id', 
            'registration_detail.registration.patient:id,name,phone,gender',
            'registration_detail.polyclinic:id,name',
            'registration_detail.doctor:id,name'
        )
        ->whereHas('registration_detail.registration', function(Builder $query) use($request){
            $query->whereBetween('date', [$request->date_start, $request->date_end])
            ->whereStatus(2);
        })
        ->whereHas('registration_detail', function(Builder $query) use($request, $status){
            $query->whereStatus($status)
            ->whereDestination('POLIKLINIK');
        })
        ->where('is_referenced', 0)
        ->select(
            'pivot_medical_records.id', 
            'pivot_medical_records.registration_detail_id', 
            'pivot_medical_records.medical_record_id');

        $user = Auth::user();
        if($user->is_admin != 1) {
            if($user->contact) {
                if($user->contact->is_doctor == 1) {
                    $x->whereHas('registration_detail', function(Builder $query) use($user){
                        $query->whereDoctorId($user->contact_id);
                    });          
                }
            }
        }

        if($request->draw == 1)
            $x->orderBy('pivot_medical_records.registration_detail_id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function radiology_registered(Request $request, $flag = null) {
        $status = $flag == 'finish' ? 1 : 0;
        $x = PivotMedicalRecord::with(
            'registration_detail:id,registration_id,doctor_id,polyclinic_id',
            'registration_detail.registration:id,code,patient_id,date',
            'medical_record:id,code,registration_id,registration_detail_id', 
            'registration_detail.registration.patient:id,name,phone,gender',
            'registration_detail.polyclinic:id,name',
            'registration_detail.doctor:id,name'
        )
        ->whereHas('registration_detail.registration', function(Builder $query) use($request){
            $query->whereBetween('date', [$request->date_start, $request->date_end])
            ->whereStatus(2);
        })
        ->whereHas('registration_detail', function(Builder $query) use($request, $status){
            $query->whereDestination('RADIOLOGI');
        })
        ->orWhere('is_radiology', 1)
        ->whereHas('registration_detail', function(Builder $query) use($request, $status){
            $query->whereStatus($status);
        })
        ->orWhere('is_radiology', 1)
        ->select(
            'pivot_medical_records.id',
            'pivot_medical_records.registration_detail_id', 
            'pivot_medical_records.is_referenced', 
            'pivot_medical_records.is_laboratory_treatment', 
            'pivot_medical_records.is_radiology', 
            'pivot_medical_records.medical_record_id'
        );

        $user = Auth::user();
        if($user->is_admin != 1) {
            if($user->contact) {
                if($user->contact->is_doctor == 1) {
                    $x->whereHas('registration_detail', function(Builder $query) use($user){
                        $query->whereDoctorId($user->contact_id);
                    });          
                }
            }
        }

        if($request->draw == 1)
            $x->orderBy('pivot_medical_records.registration_detail_id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function laboratory_registered(Request $request, $flag = null) {
        $status = $flag == 'finish' ? 1 : 0;
        DB::enableQueryLog();
        $x = PivotMedicalRecord::with(
            'registration_detail:id,registration_id,doctor_id,polyclinic_id',
            'registration_detail.registration:id,code,patient_id,date',
            'medical_record:id,code,registration_id,registration_detail_id', 
            'registration_detail.registration.patient:id,name,phone,gender',
            'registration_detail.polyclinic:id,name',
            'registration_detail.doctor:id,name'
        )
        ->whereHas('registration_detail.registration', function(Builder $query) use($request){
            $query->whereBetween('date', [$request->date_start, $request->date_end])
            ->whereStatus(2);
        })
        ->whereHas('registration_detail', function(Builder $query) use($request, $status){
            $query->whereStatus($status)
            ->whereDestination('LABORATORIUM');
        })
        ->orWhere('is_laboratory_treatment', 1)
        ->whereHas('registration_detail', function(Builder $query) use($request, $status){
            $query->whereStatus($status);
        })
        ->select(
            'pivot_medical_records.id',
            'pivot_medical_records.registration_detail_id',
            'pivot_medical_records.is_referenced',
            'pivot_medical_records.is_laboratory_treatment',
            'pivot_medical_records.is_radiology',
             'pivot_medical_records.medical_record_id'
         );

        $user = Auth::user();
        if($user->is_admin != 1) {
            if($user->contact) {
                if($user->contact->is_doctor == 1) {
                    $x->whereHas('registration_detail', function(Builder $query) use($user){
                        $query->whereDoctorId($user->contact_id);
                    });          
                }
            }
        }

        if($request->draw == 1)
            $x->orderBy('pivot_medical_records.registration_detail_id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function chemoterapy_registered(Request $request, $flag = null) {
        $status = $flag == 'finish' ? 1 : 0;
        $x = PivotMedicalRecord::with(
            'registration_detail:id,registration_id,doctor_id,polyclinic_id',
            'registration_detail.registration:id,code,patient_id,date',
            'medical_record:id,code,registration_id,registration_detail_id', 
            'registration_detail.registration.patient:id,name,phone,gender',
            'registration_detail.polyclinic:id,name',
            'registration_detail.doctor:id,name'
        )
        ->whereHas('registration_detail.registration', function(Builder $query) use($request){
            $query->whereBetween('date', [$request->date_start, $request->date_end])
            ->whereStatus(2);
        })
        ->whereHas('registration_detail', function(Builder $query) use($request, $status){
            $query->whereDestination('KEMOTERAPI');
        })
        ->orWhere('is_chemoterapy', 1)
        ->whereHas('registration_detail', function(Builder $query) use($request, $status){
            $query->whereStatus($status);
        })
        ->select(
            'pivot_medical_records.id',
            'pivot_medical_records.registration_detail_id', 
            'pivot_medical_records.medical_record_id'
        );

        $user = Auth::user();
        if($user->is_admin != 1) {
            if($user->contact) {
                if($user->contact->is_doctor == 1) {
                    $x->whereHas('registration_detail', function(Builder $query) use($user){
                        $query->whereDoctorId($user->contact_id);
                    });          
                }
            }
        }

        if($request->draw == 1)
            $x->orderBy('pivot_medical_records.registration_detail_id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function ruang_tindakan_registered(Request $request, $flag = null) {
        $status = $flag == 'finish' ? 1 : 0;
        $x = PivotMedicalRecord::with(
            'registration_detail:id,registration_id,doctor_id,polyclinic_id',
            'registration_detail.registration:id,code,patient_id,date',
            'medical_record:id,code,registration_id,registration_detail_id', 
            'registration_detail.registration.patient:id,name,phone,gender',
            'registration_detail.polyclinic:id,name',
            'registration_detail.doctor:id,name'
        )
        ->whereHas('registration_detail.registration', function(Builder $query) use($request){
            $query->whereBetween('date', [$request->date_start, $request->date_end])
            ->whereStatus(2);
        })
        ->whereHas('registration_detail', function(Builder $query) use($request, $status){
            $query->whereStatus($status)
            ->whereDestination('RUANG TINDAKAN');
        })
        ->orWhere('is_ruang_tindakan', 1)
        ->select(
            'pivot_medical_records.id',
            'pivot_medical_records.is_referenced',
            'pivot_medical_records.is_laboratory',
            'pivot_medical_records.registration_detail_id',
            'pivot_medical_records.medical_record_id'
        );

        $user = Auth::user();
        if($user->is_admin != 1) {
            if($user->contact) {
                if($user->contact->is_doctor == 1) {
                    $x->whereHas('registration_detail', function(Builder $query) use($user){
                        $query->whereDoctorId($user->contact_id);
                    });          
                }
            }
        }

        if($request->draw == 1)
            $x->orderBy('pivot_medical_records.registration_detail_id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function medical_checkup_registered(Request $request, $flag = null) {
        $status = $flag == 'finish' ? 1 : 0;
        $x = PivotMedicalRecord::with(
            'registration_detail:id,registration_id,doctor_id,polyclinic_id',
            'registration_detail.registration:id,code,patient_id,date',
            'medical_record:id,code,registration_id,registration_detail_id', 
            'registration_detail.registration.patient:id,name,phone,gender',
            'registration_detail.polyclinic:id,name',
            'registration_detail.doctor:id,name'
        )
        ->whereHas('registration_detail.registration', function(Builder $query) use($request){
            $query->whereBetween('date', [$request->date_start, $request->date_end])
            ->whereStatus(2);
        })
        ->whereHas('registration_detail', function(Builder $query) use($request, $status){
            $query->whereStatus($status)
            ->whereDestination('MEDICAL CHECK-UP');
        })
        ->where('is_referenced', 0)
        ->select(
            'pivot_medical_records.id',
            'pivot_medical_records.registration_detail_id', 
            'pivot_medical_records.medical_record_id');

        $user = Auth::user();
        if($user->is_admin != 1) {
            if($user->contact) {
                if($user->contact->is_doctor == 1) {
                    $x->whereHas('registration_detail', function(Builder $query) use($user){
                        $query->whereDoctorId($user->contact_id);
                    });          
                }
            }
        }

        if($request->draw == 1)
            $x->orderBy('pivot_medical_records.registration_detail_id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }


    public function medical_record(Request $request) {
        $x = MedicalRecord::with('registration_detail:id,registration_id,doctor_id', 
            'registration_detail.doctor:id,name,specialization_id',
            'registration_detail.doctor.specialization:id,name',
            'patient:id,name,age,birth_date,gender,city_id,phone,address',
            'patient.city:id,name', 'registration_detail.registration:id,code,date'
        )
        ->select('medical_records.code','medical_records.patient_id','medical_records.id', 'registration_detail_id');
        //->groupBy('medical_records.code');

        // if($request->draw == 1)
        //     $x->orderBy('medical_records.id', 'DESC');

        return Datatables::of($x)
        ->order(function ($query) {
                $query->orderBy('medical_records.code', 'desc');
        })
        ->make(true);
    }

    public function medical_record_history(Request $request) {
        $x = DB::table('medical_records');

        // if($request->draw == 1)
        //     $x->orderBy('medical_records.id', 'DESC');

        return Datatables::of($x)->make(true);
    }

    public function medical_records(Request $request, $patient_id) {
        $x = PivotMedicalRecord::with(
            'registration_detail:id,registration_id,doctor_id,destination',
            'registration_detail.doctor:id,name,registration_id', 
            'medical_record',
            'registration_detail.registration:id,code',
            'registration_detail.registration.invoice:id,registration_id,status'
        )
        ->whereHas('medical_record', function(Builder $query) use($request, $patient_id){
            $query->wherePatientId($patient_id);
        })
        ->select('pivot_medical_records.registration_detail_id', 'pivot_medical_records.medical_record_id');

        if(Auth::user()->is_admin != 1) {
            if(Auth::user()->doctor) {
                $x->whereHas('registration_detail', function(Builder $query){
                    $query->whereDoctorId(Auth::user()->contact_id);
                });
            }
        }
        if($request->draw == 1)
            $x->orderBy('pivot_medical_records.registration_detail_id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function polyclinic_medical_record(Request $request, $patient_id) {
        $x = PivotMedicalRecord::with(
            'registration_detail:id,registration_id,doctor_id',
            'registration_detail.doctor:id,name,registration_id', 
            'medical_record:id,registration_detail_id,code,main_complaint,date',
            'registration_detail.registration:id',
            'registration_detail.registration.invoice:id,registration_id,status'
        )
        ->whereHas('medical_record', function(Builder $query) use($request, $patient_id){
            $query->wherePatientId($patient_id);
        })
        ->whereHas('registration_detail', function(Builder $query) use($request){
            $query->whereDestination('POLIKLINIK');
        })
        ->select('pivot_medical_records.registration_detail_id', 'pivot_medical_records.medical_record_id');

        if(Auth::user()->is_admin != 1) {
            if(Auth::user()->doctor) {
                $x->whereHas('registration_detail', function(Builder $query){
                    $query->whereDoctorId(Auth::user()->contact_id);
                });
            }
        }
        if($request->draw == 1)
            $x->orderBy('pivot_medical_records.registration_detail_id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function radiology_medical_record(Request $request, $patient_id) {
        $x = PivotMedicalRecord::with(
            'registration_detail:id,registration_id,doctor_id',
            'registration_detail.doctor:id,name,registration_id', 
            'medical_record:id,registration_detail_id,code,main_complaint,date',
            'registration_detail.registration:id',
            'registration_detail.registration.invoice:id,registration_id,status'
        )
        ->whereHas('medical_record', function(Builder $query) use($request, $patient_id){
            $query->wherePatientId($patient_id);
        })
        ->whereHas('registration_detail', function(Builder $query) use($request){
            $query->whereDestination('RADIOLOGI');
        })
        ->select('pivot_medical_records.registration_detail_id', 'pivot_medical_records.medical_record_id');

        if(Auth::user()->is_admin != 1) {
            if(Auth::user()->doctor) {
                $x->whereHas('registration_detail', function(Builder $query){
                    $query->whereDoctorId(Auth::user()->contact_id);
                });
            }
        }
        if($request->draw == 1)
            $x->orderBy('pivot_medical_records.registration_detail_id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function laboratory_medical_record(Request $request, $patient_id) {
        $x = PivotMedicalRecord::with(
            'registration_detail:id,registration_id,doctor_id',
            'registration_detail.doctor:id,name,registration_id', 
            'medical_record:id,registration_detail_id,code,main_complaint,date',
            'registration_detail.registration:id',
            'registration_detail.registration.invoice:id,registration_id,status'
        )
        ->whereHas('medical_record', function(Builder $query) use($request, $patient_id){
            $query->wherePatientId($patient_id);
        })
        ->whereHas('registration_detail', function(Builder $query) use($request){
            $query->whereDestination('LABORATORIUM');
        })
        ->select('pivot_medical_records.registration_detail_id', 'pivot_medical_records.medical_record_id');

        if(Auth::user()->is_admin != 1) {
            if(Auth::user()->doctor) {
                $x->whereHas('registration_detail', function(Builder $query){
                    $query->whereDoctorId(Auth::user()->contact_id);
                });
            }
        }
        if($request->draw == 1)
            $x->orderBy('pivot_medical_records.registration_detail_id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function chemoterapy_medical_record(Request $request, $patient_id) {
        $x = PivotMedicalRecord::with(
            'registration_detail:id,registration_id,doctor_id',
            'registration_detail.doctor:id,name,registration_id', 
            'medical_record:id,registration_detail_id,code,main_complaint,date',
            'registration_detail.registration:id',
            'registration_detail.registration.invoice:id,registration_id,status'
        )
        ->whereHas('medical_record', function(Builder $query) use($request, $patient_id){
            $query->wherePatientId($patient_id);
        })
        ->whereHas('registration_detail', function(Builder $query) use($request){
            $query->whereDestination('KEMOTERAPI');
        })
        ->select('pivot_medical_records.registration_detail_id', 'pivot_medical_records.medical_record_id');

        if(Auth::user()->is_admin != 1) {
            if(Auth::user()->doctor) {
                $x->whereHas('registration_detail', function(Builder $query){
                    $query->whereDoctorId(Auth::user()->contact_id);
                });
            }
        }
        if($request->draw == 1)
            $x->orderBy('pivot_medical_records.registration_detail_id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function ruang_tindakan_medical_record(Request $request, $patient_id) {
        $x = PivotMedicalRecord::with(
            'registration_detail:id,registration_id,doctor_id',
            'registration_detail.doctor:id,name,registration_id', 
            'medical_record:id,registration_detail_id,code,main_complaint,date',
            'registration_detail.registration:id',
            'registration_detail.registration.invoice:id,registration_id,status'
        )
        ->whereHas('medical_record', function(Builder $query) use($request, $patient_id){
            $query->wherePatientId($patient_id);
        })
        ->whereHas('registration_detail', function(Builder $query) use($request){
            $query->whereDestination('RUANG TINDAKAN');
        })
        ->select('pivot_medical_records.registration_detail_id', 'pivot_medical_records.medical_record_id');

        if(Auth::user()->is_admin != 1) {
            if(Auth::user()->doctor) {
                $x->whereHas('registration_detail', function(Builder $query){
                    $query->whereDoctorId(Auth::user()->contact_id);
                });
            }
        }
        if($request->draw == 1)
            $x->orderBy('pivot_medical_records.registration_detail_id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }


    public function medical_checkup_medical_record(Request $request, $patient_id) {
        $x = PivotMedicalRecord::with(
            'registration_detail:id,registration_id,doctor_id',
            'registration_detail.doctor:id,name,registration_id', 
            'medical_record:id,registration_detail_id,code,main_complaint,date',
            'registration_detail.registration:id',
            'registration_detail.registration.invoice:id,registration_id,status'
        )
        ->whereHas('medical_record', function(Builder $query) use($request, $patient_id){
            $query->wherePatientId($patient_id);
        })
        ->whereHas('registration_detail', function(Builder $query) use($request){
            $query->whereDestination('MEDICAL CHECK-UP');
        })
        ->select('pivot_medical_records.registration_detail_id', 'pivot_medical_records.medical_record_id');

        if(Auth::user()->is_admin != 1) {
            if(Auth::user()->doctor) {
                $x->whereHas('registration_detail', function(Builder $query){
                    $query->whereDoctorId(Auth::user()->contact_id);
                });
            }
        }
        if($request->draw == 1)
            $x->orderBy('pivot_medical_records.registration_detail_id', 'DESC');

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
