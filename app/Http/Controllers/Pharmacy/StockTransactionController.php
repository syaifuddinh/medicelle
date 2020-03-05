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

        $latest_id = StockTransaction::whereBetween('date', [$request->date_start, $request->date_end])
        ->max('id');

        $stock_transaction = StockTransaction::find($latest_id);
        return Response::json(['qty' => $stock_transaction->qty ?? 0]);

    }

    // Mencari barang berdasarkan item id dan lokasi
    public function check_by_lokasi(Request $request) {
        if(!$request->filled('item_id')) {
            return Response::json(['message' => 'Barang tidak boleh kosong'], 500);
        }        
        

        $stock = DB::table('stocks')
        ->whereItemId($request->item_id)
        ->whereLokasiId($request->lokasi_id)
        ->select('qty')
        ->first();

        return Response::json(['qty' => $stock->qty ?? 0]);

    }
}
