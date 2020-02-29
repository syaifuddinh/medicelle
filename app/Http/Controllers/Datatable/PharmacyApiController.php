<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\PurchaseRequest;
use DataTables;

class PharmacyApiController extends Controller
{
    public function purchase_request(Request $request) {
        $x = PurchaseRequest::where('date_start', '<=', $request->date_start)
        ->where('date_end', '>=', $request->date_end)
        ->select('id', 'description', 'date_start', 'date_end', 'is_approve');
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }
}
