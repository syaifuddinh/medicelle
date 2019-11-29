<?php

namespace App\Http\Controllers\Assesment;

use App\Assesment;
use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class AssesmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assesment = Assesment::whereRaw('1=1')->select('id', 'code')->get();
        return Response::json($assesment, 200);
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
    public function store(Request $request, Assesment $assesment)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\piece  $assesment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assesment = Assesment::with('registration:id,code', 'registration.medical_record:id,code', 'patient.id:name')->find($id);
        return Response::json($assesment, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\piece  $assesment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assesment $assesment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\piece  $assesment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $assesment = Assesment::find($id);

        $assesment->fill($request->all());
        $assesment->save();
        
        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\piece  $assesment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $assesment = Assesment::find($id);
        $assesment->status = 3;
        $assesment->save();
        DB::commit();

        return Response::json(['message' => 'Status pasien saat ini adalah dibatalkan'], 200);
    }

    public function attend($id)
    {
        DB::beginTransaction();
        $assesment = Assesment::find($id);
        $assesment->status = 2;
        $assesment->save();
        DB::commit();

        return Response::json(['message' => 'Status pasien saat ini adalah telah hadir'], 200);
    }
}
