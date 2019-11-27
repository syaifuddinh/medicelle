<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Registration;
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

}
