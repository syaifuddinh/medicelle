<?php

namespace App\Http\Controllers\Letter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Letter;
use DB;
use PDF;
use Response;

class LayakTerbangController extends Controller
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
        ], [
            'date.required' => 'Tanggal tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $letter = new Letter();
        $letter->fill($request->all());
        $letter->is_layak_terbang = 1;
        $letter->save();
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
        $letter = Letter::with('medical_record:id,code,patient_id', 'medical_record.patient','medical_record.patient.city:id,name', 'doctor:id,name,specialization_id', 'doctor.specialization:id,name')->findOrFail($id);
        return Response::json($letter, 200);
    }

    public function pdf($id)
    {
        $letter = Letter::with('medical_record:id,code,patient_id', 'medical_record.patient','medical_record.patient.city:id,name', 'doctor:id,name,specialization_id', 'doctor.specialization:id,name')->findOrFail($id);
        $pdf = PDF::loadview('pdf/layak_terbang',['letter'=>$letter]);
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
        $letter = Letter::findOrFail($id);
        $letter->fill($request->all());
        $letter->is_layak_terbang = 1;
        $letter->save();
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
        $letter = Letter::findOrFail($id);
        $letter->delete();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }

    public function activate(User $user)
    {
        //
        DB::beginTransaction();
        $user->is_active = 1;
        $user->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }
}
