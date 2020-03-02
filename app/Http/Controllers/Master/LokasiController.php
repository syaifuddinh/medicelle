<?php

namespace App\Http\Controllers\Master;

use App\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lokasi = Permission::whereIsLokasi(1)->select('id', 'name')->get();
        return Response::json($lokasi, 200);
    }

    public function actived()
    {
        $lokasi = Permission::whereIsLokasi(1)
        ->whereIsActive(1)
        ->select('id', 'name')->get();
        return Response::json($lokasi, 200);
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
            'name' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $lokasi = new Permission();
        $lokasi->fill($request->all());
        $lokasi->is_lokasi = 1;
        $lokasi->save();
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil diinput'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lokasi = Permission::findOrFail($id);
        return Response::json($lokasi, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $lokasi)
    {
        //
    }

    public function gudang_farmasi()
    {
        return Response::json(Permission::gudang_farmasi());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $lokasi = Permission::find($id);
        $lokasi->fill($request->all());
        $lokasi->save();
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $lokasi = Permission::findOrFail($id);
        $lokasi->is_active = 0;
        $lokasi->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }

    public function activate($id)
    {
        DB::beginTransaction();
        $lokasi = Permission::findOrFail($id);
        $lokasi->is_active = 1;
        $lokasi->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }
}
