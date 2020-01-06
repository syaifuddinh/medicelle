<?php

namespace App\Http\Controllers\Master;

use App\Discount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discount = Discount::select('id', 'code', 'name')->get();
        return Response::json($discount, 200);
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
    public function store(Request $request, Discount $discount)
    {
        $request->validate([
            'name' => 'required|unique:discounts,name',
        ], [
            'name.unique' => 'Nama sudah digunakan',
            'name.required' => 'Nama tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $discount->fill($request->all());
        $discount->save();
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil diinput'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        return Response::json($discount, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, discount $discount)
    {
        $request->validate([
            'name' => 'required|unique:discounts,name,' . $discount->id,
        ], [
            'name.unique' => 'Nama sudah digunakan',
            'name.required' => 'Nama tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $discount->fill($request->all());
        $discount->save();
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        DB::beginTransaction();
        $discount->is_active = 0;
        $discount->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }

    public function activate(Discount $discount)
    {
        DB::beginTransaction();
        $discount->is_active = 1;
        $discount->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }
}
