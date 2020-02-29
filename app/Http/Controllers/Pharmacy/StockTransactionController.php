<?php

namespace App\Http\Controllers\Pharmacy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\StockTransaction;
use Response;

class StockTransactionController extends Controller
{
    public function check(Request $request) {
        if(!$request->filled('item_id')) {
            return Response::json(['message' => 'Barang tidak boleh kosong'], 500);
        }

        $latest_id = StockTransaction::whereBetween('date', [$request->date_start, $date_end])
        ->max('id');

        $stock_transaction = StockTransaction::find($latest_id);
        return Response::json(['qty' => $stock_transaction->qty ?? 0]);

    }
}
