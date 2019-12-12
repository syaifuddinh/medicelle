<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Invoice;
use DataTables;

class CashierApiController extends Controller
{
    public function cashier(Request $request) {
        $x = Invoice::with('registration:id,code,medical_record_id,date,patient_id', 'registration.medical_record:id,code', 'registration.patient:id,name')->select('invoices.id', 'registration_id', 'invoices.status', 'invoices.date')
            ->whereIsNotaRawatJalan(1)
            ->whereHas('registration', function(Builder $query) use($request){
                $query->whereBetween('date', [$request->date_start, $request->date_end]);
            });

        if($request->filled('status')) {
            $x = $x->where('invoices.status', $request->status);
        }

        if($request->draw == 1)
            $x->orderBy('invoices.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

}
