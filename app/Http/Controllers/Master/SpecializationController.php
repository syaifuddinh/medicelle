<?php

namespace App\Http\Controllers\Master;

use App\Specialization;
use App\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specialization = Specialization::select('id', 'code', 'name')->whereIsActive(1)->get();
        return Response::json($specialization, 200);
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
    public function store(Request $request, Specialization $specialization)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $specialization->fill($request->all());
        $specialization->save();
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil diinput'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function show(Specialization $specialization)
    {
        return Response::json($specialization, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialization $specialization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, specialization $specialization)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $specialization->fill($request->all());
        $specialization->save();
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialization $specialization)
    {
        DB::beginTransaction();
        $specialization->is_active = 0;
        $specialization->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }

    public function activate(Specialization $specialization)
    {
        DB::beginTransaction();
        $specialization->is_active = 1;
        $specialization->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }

    public function medical_record_roles() {
        $roles = Setting::whereName('medical_record_roles')->first();
        return Response::json($roles->content, 200);
    }
}
