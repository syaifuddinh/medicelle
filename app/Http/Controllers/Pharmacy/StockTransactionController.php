<?php

namespace App\Http\Controllers\Pharmacy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\StockTransaction;
use DB;
use Response;

class StockTransactionController extends Controller
{
    // Mencari barang berdasarkan item id dan periode penggunaan
    public function check(Request $request) {
        if(!$request->filled('item_id')) {
            return Response::json(['message' => 'Barang tidak boleh kosong'], 500);
        }

        $stock_transaction = StockTransaction::whereBetween('date', [$request->date_start, $request->date_end])
        ->whereItemId($request->item_id)
        ->selectRaw('SUM(in_qty - out_qty) AS amount')
        ->first();

        return Response::json(['qty' => $stock_transaction->amount ?? 0]);

    }

    // Mencari barang berdasarkan item id dan lokasi
    public function check_by_lokasi(Request $request) {
        if(!$request->filled('item_id')) {
            return Response::json(['message' => 'Barang tidak boleh kosong'], 500);
        }        
        

        $stock = DB::table('stocks')
        ->whereItemId($request->item_id)
        ->whereLokasiId($request->lokasi_id)
        ->select('qty', 'expired_date')
        ->first();

        return Response::json([
            'qty' => $stock->qty ?? 0,
            'expired_date' => $stock->expired_date ?? null
        ]);

    }
    // Mencari barang berdasarkan item id
    public function check_by_item(Request $request) {
        if(!$request->filled('item_id')) {
            return Response::json(['message' => 'Barang tidak boleh kosong'], 500);
        }        
        

        $stock = DB::table('stocks')
        ->whereItemId($request->item_id)
        ->whereRaw('NOW() < expired_date')
        ->sum('qty');

        return Response::json(['qty' => $stock ?? 0]);

    }
}
