<?php

namespace App\Http\Controllers\User;

use App\SideEffect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class SideEffectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $side_effect = SideEffect::whereIsActive(1)
        ->select('id', 'name')
        ->get()
        ->chunk(2)
        ->toArray();
        return Response::json($side_effect, 200);
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
    public function store(Request $request, SideEffect $side_effect)
    {
        $request->validate([
            'name' => 'unique:permissions,name' 
        ], [
            'name.unique' => 'Nama sudah digunakan'
        ]);
        DB::beginTransaction();
        $side_effect->fill($request->all());
        $side_effect->save();
        foreach ($request->detail as $value) {
            if( null != ($value['name'] ?? null) ) {
                $side_effect->detail()->create([
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
     * @param  \App\SideEffect  $side_effect
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $side_effect = SideEffect::with('detail:side_effect_id,name')->find($id);
        return Response::json($side_effect, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SideEffect  $side_effect
     * @return \Illuminate\Http\Response
     */
    public function edit(SideEffect $side_effect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SideEffect  $side_effect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        DB::beginTransaction();
        $side_effect = SideEffect::findOrFail($id);
        $side_effect->fill($request->all());
        $side_effect->save();
        $side_effect->detail()->delete();
        foreach ($request->detail as $value) {
            if( null != ($value['name'] ?? null)) {
                $side_effect->detail()->create([
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
     * @param  \App\SideEffect  $side_effect
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $side_effect = SideEffect::findOrFail($id);
        $side_effect->is_active = 0;
        $side_effect->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }
    public function activate($id)
    {
        DB::beginTransaction();
        $side_effect = SideEffect::findOrFail($id);
        $side_effect->is_active = 1;
        $side_effect->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }
}
