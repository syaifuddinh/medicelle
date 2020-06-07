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
        $x = Invoice::with('registration:id,code,medical_record_id,date,patient_id', 'registration.medical_record:id,code', 'registration.patient:id,name')->select('invoices.id', 'invoices.code', 'registration_id', 'invoices.status', 'invoices.date')
            ->whereBetween('invoices.date', [$request->date_start, $request->date_end])
            ->whereRaw('(is_nota_rawat_jalan = 1 OR is_nota_pengobatan = 1 OR is_nota_pemeriksaan = 1)');
        if($request->filled('status')) {
            $x = $x->where('invoices.status', $request->status);
        }

        $x->orderBy('invoices.date', 'DESC')->orderBy('invoices.id', 'DESC');

        
        return Datatables::eloquent($x)->make(true);
    }

}
