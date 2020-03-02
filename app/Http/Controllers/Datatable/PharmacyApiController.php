<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\PurchaseRequest;
use App\PurchaseOrder;
use App\Receipt;
use DataTables;

class PharmacyApiController extends Controller
{
    public function purchase_request(Request $request) {
        $x = PurchaseRequest::where('date_start', '>=', $request->date_start)
        ->where('date_end', '<=', $request->date_end)
        ->select('id', 'code', 'description', 'date', 'date_start', 'date_end', 'is_approve');
        if($request->filled('is_approve'))
            $x->whereIsApprove($request->is_approve);
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function purchase_order(Request $request) {
        $x = PurchaseOrder::with('purchase_request:id,code', 'supplier:id,name')
        ->where('date_start', '>=', $request->date_start)
        ->where('date_end', '<=', $request->date_end)
        ->select('id', 'code', 'supplier_id', 'purchase_request_id', 'date', 'date_start', 'date_end', 'is_receipt_completed', 'is_used');

        if($request->filled('status')) {
            if($request->status == 1) {
                $x = $x->whereIsUsed(0)
                ->whereIsReceiptCompleted(0);
            } if($request->status == 2) {
                $x = $x->whereIsUsed(1)
                ->whereIsReceiptCompleted(0);
            } else if($request->status == 3) {
                $x = $x->whereIsUsed(1)
                ->whereIsReceiptCompleted(1);
            }
        }
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function receipt(Request $request) {
        $x = Receipt::with('purchase_order:id,code', 'supplier:id,name')
        ->where('date_start', '>=', $request->date_start)
        ->where('date_end', '<=', $request->date_end)
        ->select('id', 'code', 'supplier_id', 'purchase_order_id', 'date', 'date_start', 'date_end');

        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }
}
