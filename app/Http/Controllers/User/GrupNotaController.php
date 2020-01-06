<?php

namespace App\Http\Controllers\User;

use App\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class GrupNotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission = Permission::select('id', 'name', 'slug')
        ->whereIsActive(1)
        ->whereIsGrupNota(1)
        ->get();
        return Response::json($permission, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Permission $permission)
    {
        DB::beginTransaction();
        $permission->fill($request->all());
        $permission->is_grup_nota = 1;
        $permission->save();
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil diinput'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission, $id)
    {
        return Response::json($permission->find($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission, $id)
    {
        DB::beginTransaction();
        $permission = $permission->findOrFail($id);
        $permission->fill($request->all());
        $permission->save();
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission, $id)
    {
        DB::beginTransaction();
        $permission = $permission->find($id);
        $permission->is_active = 0;
        $permission->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }
    public function activate(Permission $permission)
    {
        DB::beginTransaction();
        $permission->is_active = 1;
        $permission->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }
}
