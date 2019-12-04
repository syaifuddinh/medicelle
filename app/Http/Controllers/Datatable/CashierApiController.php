<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cashier;
use DataTables;

class CashierApiController extends Controller
{
    public function cashier(Request $request) {
        $x = Cashier::with('medical_record', 'patient:id,name,phone')->select('cashiers.id', 'cashiers.code', 'medical_record_id', 'cashiers.patient_id', 'cashiers.date', 'cashiers.status')
        ->whereBetween('cashiers.date', [$request->date_start, $request->date_end]);

        if($request->filled('status')) {
            $x = $x->where('cashiers.status', $request->status);
        }

        if($request->draw == 1)
            $x->orderBy('cashiers.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

}
