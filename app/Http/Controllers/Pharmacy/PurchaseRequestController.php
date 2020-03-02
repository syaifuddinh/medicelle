<?php

namespace App\Http\Controllers\Pharmacy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\PurchaseRequest;
use DB;
use PDF;
use Response;

class PurchaseRequestController extends Controller
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
            'date_start' => 'required',
            'date_end' => 'required',
            'detail' => 'required',
        ], [
            'date.required' => 'Tanggal tidak boleh kosong',
            'date_start.required' => 'Periode awal tidak boleh kosong',
            'date_end.required' => 'Periode akhir tidak boleh kosong',
            'detail.required' => 'Detail barang tidak boleh kosong'
        ]);

        DB::beginTransaction();
        $purchaseRequest = new PurchaseRequest();
        $purchaseRequest->fill($request->all());
        $purchaseRequest->save();

        $entries = 0;
        foreach($request->detail as $detail) {
            if(null != ($detail['item_id'] ?? null)) {
                if(null == ($detail['supplier_id'] ?? null)) {
                    return Response::json(['message' => 'Supplier tidak boleh kosong'], 500);
                }
                ++$entries;
                $purchaseRequest->detail()->create($detail);
            }
        }
        if($entries == 0) {
            return Response::json(['message' => 'Detail barang tidak boleh kosong'], 500);
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
        $purchaseRequest = PurchaseRequest::with('detail', 'detail.item:id,name', 'detail.supplier:id,name')->findOrFail($id);
        return Response::json($purchaseRequest, 200);
    }

    public function pdf($id)
    {
        $purchaseRequest = PurchaseRequest::with('medical_record:id,code,patient_id', 'medical_record.patient','medical_record.patient.city:id,name', 'doctor:id,name,specialization_id', 'doctor.specialization:id,name')->findOrFail($id);
        $pdf = PDF::loadview('pdf/cuti_hamil',['purchaseRequest'=>$purchaseRequest]);
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
        $purchaseRequest = PurchaseRequest::findOrFail($id);
        $purchaseRequest->fill($request->all());
        $purchaseRequest->save();
        $purchaseRequest->detail()->delete();
        foreach($request->detail as $detail) {
            if(null != ($detail['item_id'] ?? null)) {
                if(null == ($detail['supplier_id'] ?? null)) {
                    return Response::json(['message' => 'Supplier tidak boleh kosong'], 500);
                }
                $purchaseRequest->detail()->create($detail);
            }
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
        $purchaseRequest = PurchaseRequest::findOrFail($id);
        $purchaseRequest->delete();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }

    public function approve($id)
    {
        //
        DB::beginTransaction();
        $purchaseRequest = PurchaseRequest::findOrFail($id);
        $purchaseRequest->is_approve = 1;
        $purchaseRequest->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil disetujui'], 200);
    }
}
