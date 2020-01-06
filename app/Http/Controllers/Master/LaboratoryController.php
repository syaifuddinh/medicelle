<?php

namespace App\Http\Controllers\Master;

use App\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class LaboratoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Item::laboratory()->has('category')->with('category:id,name')->select('id', 'code', 'name', 'category_id')->get();
        return Response::json($item, 200);
    }

    public function actived()
    {
        $item = Item::laboratory()->has('category')->with('category:id,name')->whereIsActive(1)->select('id', 'code', 'name', 'category_id')->get();
        return Response::json($item, 200);
    }

    public function category()
    {
        $item = Item::laboratory()
        ->whereNull('category_id')
        ->select('id', 'code', 'name')
        ->get();
        return Response::json($item, 200);
    }

    public function actived_category()
    {
        $item = Item::laboratory()
        ->whereNull('category_id')
        ->whereIsActive(1)
        ->select('id', 'code', 'name')
        ->get();
        return Response::json($item, 200);
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
    public function store(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $item->fill($request->all());
        $item->is_laboratory = 1;
        $item->is_pharmacy = $request->grup_nota_id ?? 0;
        $item->save();
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil diinput'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $x = Item::with('laboratory_category:id,name,code', 'price:item_id,grup_nota_id', 'price.grup_nota:id,slug,name', 'piece:id,name')->find($id);
        return Response::json($x, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $item = Item::find($id);
        $item->fill($request->all());
        $item->price = $request->price;
        $item->is_laboratory = 1;
        $item->is_pharmacy = $request->grup_nota_id ?? 0;
        $item->save();
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $item = Item::find($id);
        $item->is_active = 0;
        $item->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }

    public function activate($id)
    {
        DB::beginTransaction();
        $item = Item::find($id);
        $item->is_active = 1;
        $item->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }
}
