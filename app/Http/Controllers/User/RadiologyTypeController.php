<?php

namespace App\Http\Controllers\User;

use App\RadiologyType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class RadiologyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $radiology_type = RadiologyType::whereIsActive(1)
        ->select('id', 'name')
        ->get();
        return Response::json($radiology_type, 200);
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
    public function store(Request $request, RadiologyType $radiology_type)
    {
        $request->validate([
            'name' => 'unique:permissions,name' 
        ], [
            'name.unique' => 'Nama sudah digunakan'
        ]);
        DB::beginTransaction();
        $radiology_type->fill($request->all());
        $radiology_type->save();
        foreach ($request->detail as $value) {
            if( null != ($value['name'] ?? null) ) {
                $radiology_type->radiology_type_detail()->create([
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
     * @param  \App\RadiologyType  $radiology_type
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $radiology_type = RadiologyType::with('radiology_type_detail:radiology_type_id,name')->find($id);
        return Response::json($radiology_type, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RadiologyType  $radiology_type
     * @return \Illuminate\Http\Response
     */
    public function edit(RadiologyType $radiology_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RadiologyType  $radiology_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        DB::beginTransaction();
        $radiology_type = RadiologyType::findOrFail($id);
        $radiology_type->fill($request->all());
        $radiology_type->save();
        $radiology_type->radiology_type_detail()->delete();
        foreach ($request->detail as $value) {
            if( null != ($value['name'] ?? null)) {
                $radiology_type->radiology_type_detail()->create([
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
     * @param  \App\RadiologyType  $radiology_type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $radiology_type = RadiologyType::findOrFail($id);
        $radiology_type->is_active = 0;
        $radiology_type->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }
    public function activate($id)
    {
        DB::beginTransaction();
        $radiology_type = RadiologyType::findOrFail($id);
        $radiology_type->is_active = 1;
        $radiology_type->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }
}
