<?php

namespace App\Http\Controllers\Pharmacy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\AdjustmentStock;
use DB;
use PDF;
use Response;
use Exception;

class AdjustmentStockController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'detail' => 'required',
        ], [
            'date.required' => 'Tanggal tidak boleh kosong',
            'detail.required' => 'Detail barang tidak boleh kosong'
        ]);

        DB::beginTransaction();
        try {
            $adjustmentStock = new AdjustmentStock();
            $adjustmentStock->fill($request->all());
            $adjustmentStock->save();

            $entries = 0;
            foreach($request->detail as $detail) {
                if(null != ($detail['item_id'] ?? null)) {
                    ++$entries;
                    $adjustmentStock->detail()->create($detail);
                }
            }
            if($entries == 0) {
                return Response::json(['message' => 'Detail barang tidak boleh kosong'], 500);
            }
        } catch (Exception $e) {
            // dd($e);
            return Response::json(['message' => $e->getMessage()], 421);
        }
        
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil di-input'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adjustmentStock = AdjustmentStock::with('detail:id,adjustment_stock_id,item_id,qty,previous_qty,stock_transaction_id,lokasi_id', 'detail.item:id,name', 'detail.lokasi:id,name', 'detail.stock_transaction:id,stock_id', 'detail.stock_transaction.stock:id,qty')->findOrFail($id);
        return Response::json($adjustmentStock, 200);
    }

    public function pdf($id)
    {
        $adjustmentStock = AdjustmentStock::with('medical_record:id,code,patient_id', 'medical_record.patient','medical_record.patient.city:id,name', 'doctor:id,name,specialization_id', 'doctor.specialization:id,name')->findOrFail($id);
        $pdf = PDF::loadview('pdf/cuti_hamil',['AdjustmentStock'=>$adjustmentStock]);
        return $pdf->stream('cuti-hamil.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
        ], [
            'date.required' => 'Tanggal sudah digunakan'
        ]);
        DB::beginTransaction();
        try {
            $adjustmentStock = AdjustmentStock::findOrFail($id);
            $adjustmentStock->fill($request->all());
            $adjustmentStock->save();
            $adjustmentStock->detail()->delete();
            foreach($request->detail as $detail) {
                if(null != ($detail['item_id'] ?? null)) {
                    if(null == ($detail['supplier_id'] ?? null)) {
                        return Response::json(['message' => 'Supplier tidak boleh kosong'], 500);
                    }
                    $adjustmentStock->detail()->create($detail);
                }
            }
        } catch (Exception $e) {
            dd($e);
        }
        
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::beginTransaction();
        $adjustmentStock = AdjustmentStock::findOrFail($id);
        $adjustmentStock->delete();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }

    public function approve($id)
    {
        //
        DB::beginTransaction();
        $adjustmentStock = AdjustmentStock::findOrFail($id);
        $adjustmentStock->is_approve = 1;
        $adjustmentStock->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil disetujui'], 200);
    }
}
