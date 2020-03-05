<?php

namespace App\Http\Controllers\Pharmacy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Movement;
use DB;
use PDF;
use Response;

class MovementController extends Controller
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
            $movement = new Movement();
            $movement->fill($request->all());
            $movement->save();

            $entries = 0;
            foreach($request->detail as $detail) {
                if(null != ($detail['item_id'] ?? null)) {
                    ++$entries;
                    $movement->detail()->create($detail);
                }
            }
            if($entries == 0) {
                return Response::json(['message' => 'Detail barang tidak boleh kosong'], 500);
            }
        } catch (Exception $e) {
            dd($e);
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
        $movement = Movement::with('detail:id,movement_id,item_id,qty,stock_transaction_source_id,stock_transaction_destination_id,lokasi_awal_id,lokasi_akhir_id', 'detail.item:id,name', 'detail.lokasi_awal:id,name', 'detail.lokasi_akhir:id,name', 'detail.stock_transaction_source:id,stock_id', 'detail.stock_transaction_source.stock:id,qty', 'detail.stock_transaction_destination:id,stock_id', 'detail.stock_transaction_destination.stock:id,qty')->findOrFail($id);
        return Response::json($movement, 200);
    }

    public function pdf($id)
    {
        $movement = Movement::with('medical_record:id,code,patient_id', 'medical_record.patient','medical_record.patient.city:id,name', 'doctor:id,name,specialization_id', 'doctor.specialization:id,name')->findOrFail($id);
        $pdf = PDF::loadview('pdf/cuti_hamil',['movement'=>$movement]);
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
            $movement = Movement::findOrFail($id);
            $movement->fill($request->all());
            $movement->save();
            $movement->detail()->delete();
            foreach($request->detail as $detail) {
                if(null != ($detail['item_id'] ?? null)) {
                    if(null == ($detail['supplier_id'] ?? null)) {
                        return Response::json(['message' => 'Supplier tidak boleh kosong'], 500);
                    }
                    $movement->detail()->create($detail);
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
        $movement = Movement::findOrFail($id);
        $movement->delete();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }

    public function approve($id)
    {
        //
        DB::beginTransaction();
        $movement = Movement::findOrFail($id);
        $movement->is_approve = 1;
        $movement->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil disetujui'], 200);
    }
}
