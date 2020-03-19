<?php

namespace App\Http\Controllers\User;

use App\LaboratoryType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class LaboratoryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laboratory_type = LaboratoryType::whereIsActive(1)
        ->select('id', 'name')
        ->get()
        ->chunk(2)
        ->toArray();
        return Response::json($laboratory_type, 200);
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
    public function store(Request $request, LaboratoryType $laboratory_type)
    {
        $request->validate([
            'name' => 'unique:permissions,name' 
        ], [
            'name.unique' => 'Nama sudah digunakan'
        ]);
        DB::beginTransaction();
        $laboratory_type->fill($request->all());
        $laboratory_type->save();
        foreach ($request->detail as $value) {
            if( null != ($value['name'] ?? null) ) {
                $laboratory_type->laboratory_type_detail()->create([
                    'name' => $value['name']
                ]);
            }
        }
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil diinput'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LaboratoryType  $laboratory_type
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $laboratory_type = LaboratoryType::with('laboratory_type_detail:laboratory_type_id,name')->find($id);
        return Response::json($laboratory_type, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LaboratoryType  $laboratory_type
     * @return \Illuminate\Http\Response
     */
    public function edit(LaboratoryType $laboratory_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LaboratoryType  $laboratory_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        DB::beginTransaction();
        $laboratory_type = LaboratoryType::findOrFail($id);
        $laboratory_type->fill($request->all());
        $laboratory_type->save();
        $laboratory_type->laboratory_type_detail()->delete();
        foreach ($request->detail as $value) {
            if( null != ($value['name'] ?? null)) {
                $laboratory_type->laboratory_type_detail()->create([
                    'name' => $value['name']
                ]);
            }
        }
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LaboratoryType  $laboratory_type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $laboratory_type = LaboratoryType::findOrFail($id);
        $laboratory_type->is_active = 0;
        $laboratory_type->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }
    public function activate($id)
    {
        DB::beginTransaction();
        $laboratory_type = LaboratoryType::findOrFail($id);
        $laboratory_type->is_active = 1;
        $laboratory_type->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }
}
