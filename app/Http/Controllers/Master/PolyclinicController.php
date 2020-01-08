<?php

namespace App\Http\Controllers\Master;

use App\Polyclinic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class PolyclinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polyclinic = Polyclinic::select('id', 'code', 'name')->whereIsActive(1)->get();
        return Response::json($polyclinic, 200);
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
    public function store(Request $request, Polyclinic $polyclinic)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $polyclinic->fill($request->all());
        $polyclinic->save();
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil diinput'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\polyclinic  $polyclinic
     * @return \Illuminate\Http\Response
     */
    public function show(Polyclinic $polyclinic)
    {
        return Response::json($polyclinic, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\polyclinic  $polyclinic
     * @return \Illuminate\Http\Response
     */
    public function edit(Polyclinic $polyclinic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\polyclinic  $polyclinic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, polyclinic $polyclinic)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $polyclinic->fill($request->all());
        $polyclinic->save();
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\polyclinic  $polyclinic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Polyclinic $polyclinic)
    {
        DB::beginTransaction();
        $polyclinic->is_active = 0;
        $polyclinic->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }

    public function activate(Polyclinic $polyclinic)
    {
        DB::beginTransaction();
        $polyclinic->is_active = 1;
        $polyclinic->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }
}
