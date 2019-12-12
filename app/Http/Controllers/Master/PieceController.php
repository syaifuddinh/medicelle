<?php

namespace App\Http\Controllers\Master;

use App\Piece;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class PieceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $piece = Piece::whereRaw('1=1')->select('id', 'name')->get();
        return Response::json($piece, 200);
    }

    public function actived()
    {
        $piece = Piece::whereIsActive(1)->select('id', 'name')->get();
        return Response::json($piece, 200);
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
    public function store(Request $request, Piece $piece)
    {
        $request->validate([
            'name' => 'required|unique:pieces,name',
        ], [
            'name.unique' => 'Nama sudah digunakan',
            'name.required' => 'Nama tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $piece->fill($request->all());
        $piece->save();
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil diinput'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\piece  $piece
     * @return \Illuminate\Http\Response
     */
    public function show(Piece $piece)
    {
        return Response::json($piece, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\piece  $piece
     * @return \Illuminate\Http\Response
     */
    public function edit(Piece $piece)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\piece  $piece
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, piece $piece)
    {
        $request->validate([
            'name' => 'required|unique:pieces,name,' . $piece->id,
        ], [
            'name.unique' => 'Nama sudah digunakan',
            'name.required' => 'Nama tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $piece->fill($request->all());
        $piece->save();
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\piece  $piece
     * @return \Illuminate\Http\Response
     */
    public function destroy(Piece $piece)
    {
        DB::beginTransaction();
        $piece->is_active = 0;
        $piece->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }

    public function activate(Piece $piece)
    {
        DB::beginTransaction();
        $piece->is_active = 1;
        $piece->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }
}
