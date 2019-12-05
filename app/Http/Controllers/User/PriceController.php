<?php

namespace App\Http\Controllers\User;

use App\Price;
use App\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;
use Str;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $price = Price::select('id', 'name')
        ->whereIsActive(1)
        ->whereIsGrupNota(1)
        ->get();
        return Response::json($price, 200);
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
    public function store(Request $request, Price $price)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'price.required' => 'Harga tidak boleh kosong'
        ]);
        DB::beginTransaction();
        $price->fill($request->all());
        $item = new Item();
        $item->is_administration = 1;
        $item->name = $request->name;
        $item->code = date('Ym') . Str::random(4);
        $item->price = $request->price;
        $item->save();
        $price->item_id = $item->id;
        $price->custom_price = $request->price;
        $price->save();
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil diinput'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $price = Price::with('grup_nota:id,slug,name', 'service:id,name,price', 'polyclinic:id,name');
        return Response::json($price->find($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function edit(Price $price)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Price $price, $id)
    {
         $request->validate([
            'name' => 'required',
            'price' => 'required'
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'price.required' => 'Harga tidak boleh kosong'
        ]);
        DB::beginTransaction();
        $price = Price::find($id);
        $price->fill($request->all());
        $item = Item::find($price->item_id);
        $item->name = $request->name;
        $item->price = $request->price;
        $item->save();
        $price->custom_price = $request->price;
        $price->save();
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $price = Price::find($id);
        $price->is_active = 0;
        $price->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }
    public function activate(Price $price)
    {
        DB::beginTransaction();
        $price->is_active = 1;
        $price->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }
}
