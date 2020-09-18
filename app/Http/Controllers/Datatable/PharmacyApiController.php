<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\PurchaseRequest;
use App\PurchaseOrder;
use App\Movement;
use App\AdjustmentStock;
use App\Receipt;
use App\Formula;
use App\Stock;
use Carbon\Carbon;
use DB;
use DataTables;
use Response;

class PharmacyApiController extends Controller
{
    public function movement(Request $request) {
        $x = Movement::with('creator:id,name')
        ->whereBetween('date', [$request->date_start, $request->date_end])
        ->select('movements.id', 'movements.date', 'movements.created_by');

        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function formula(Request $request) {
        $x = Formula::with('medical_record:id,code', 'registration_detail:id,registration_id', 'registration_detail.registration:id,patient_id,code', 'registration_detail.registration.patient:id,name')
        ->whereBetween('formulas.date', [$request->date_start, $request->date_end])
        ->select('formulas.id', 'formulas.date', 'formulas.medical_record_id', 'formulas.registration_detail_id', 'formulas.is_approve');

        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        if($request->filled('is_approve'))
            $x->where('formulas.is_approve', $request->is_approve);

        return Datatables::eloquent($x)->make(true);
    }

    public function adjustment_stock(Request $request) {
        $x = AdjustmentStock::with('creator:id,name')
        ->whereBetween('date', [$request->date_start, $request->date_end])
        ->select('adjustment_stocks.id', 'adjustment_stocks.date', 'adjustment_stocks.created_by');

        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function purchase_request(Request $request) {
        $x = PurchaseRequest::where('date_start', '>=', $request->date_start)
        ->where('date_end', '<=', $request->date_end)
        ->select('id', 'code', 'description', 'date', 'date_start', 'date_end', 'status');
        if($request->filled('status'))
            $x->whereStatus($request->status);

        return Datatables::eloquent($x)->make(true);
    }

    public function purchase_order(Request $request) {
        $x = PurchaseOrder::with('purchase_request:id,code', 'supplier:id,name')
        ->where('purchase_orders.date_start', '>=', $request->date_start)
        ->where('purchase_orders.date_end', '<=', $request->date_end)
        ->select('purchase_orders.id', 'purchase_orders.code', 'purchase_orders.supplier_id', 'purchase_orders.purchase_request_id', 'purchase_orders.date', 'purchase_orders.date_start', 'purchase_orders.date_end', 'purchase_orders.is_receipt_completed', 'purchase_orders.is_used');

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
            } else if($request->status == 4) {
                $x = $x->whereIsReceiptCompleted(0);
            }
        }

        return Datatables::eloquent($x)->make(true);
    }

    public function receipt(Request $request) {
        $x = Receipt::with('purchase_order:id,code', 'supplier:id,name')
        ->where('receipts.date_start', '>=', $request->date_start)
        ->where('receipts.date_end', '<=', $request->date_end)
        ->select('receipts.id', 'receipts.code', 'receipts.supplier_id', 'receipts.purchase_order_id', 'receipts.date', 'receipts.date_start', 'receipts.date_end');

        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function history(Request $request) {
        $month = Carbon::parse($request->date_start)->format('m') - 1;
        $month = $month == 0 ? 12 : $month;
        $year = Carbon::parse($request->date_start)->format('Y') ;
        $year  = $month == 0 ? $year - 1 : $year;
        $x = Stock::with('item:id,name,category_id,classification_id,subclassification_id,generic_id,piece_id', 'item.piece:id,name', 'item.group:id,name', 'item.classification:id,name', 'item.subclassification:id,name', 'item.generic:id,name', 'lokasi:id,name')
        ->select(
            'stocks.id', 
            'stocks.item_id', 
            'stocks.lokasi_id', 
            'stocks.expired_date', 
            DB::raw("COALESCE((SELECT amount FROM stock_transactions WHERE id = (SELECT MAX(id) FROM stock_transactions WHERE stock_id = stocks.id AND (date BETWEEN '$request->date_start' AND '$request->date_end') )), 0) AS latest_stock"),
            DB::raw("COALESCE((SELECT gross FROM periodical_stocks WHERE stock_id = stocks.id AND year = $year AND month = $month ), 0) AS early_stock")
        );
        if($request->draw == 1)
            $x->orderBy('stocks.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function distribution(Request $request) {
        $x = Stock::with('item:id,name', 'lokasi:id,name')
        ->select(
            'stocks.id', 
            'stocks.item_id', 
            'stocks.lokasi_id', 
            'stocks.expired_date', 
            DB::raw("COALESCE((SELECT amount FROM stock_transactions WHERE id = (SELECT MAX(id) FROM stock_transactions WHERE stock_id = stocks.id AND (date BETWEEN '$request->date_start' AND '$request->date_end') )), 0) AS latest_stock")
        );
        if($request->draw == 1)
            $x->orderBy('stocks.id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }
}
