<?php

namespace App\Http\Controllers\Master;

use App\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Item::cure()->has('category')->with('category:id,name')->select('id', 'code', 'name', 'category_id')->get();
        return Response::json($item, 200);
    }

    public function actived()
    {
        $item = Item::cure()->has('category')->with('category:id,name')->whereIsActive(1)->select('id', 'code', 'name', 'category_id')->get();
        return Response::json($item, 200);
    }

    public function category()
    {
        $item = Item::cure()
        ->whereNull('category_id')
	->whereIsCategory(1)
        ->select('id', 'code', 'name')
        ->get();
        return Response::json($item, 200);
    }

    public function actived_category()
    {
        $item = Item::whereIsCure(1)
        ->whereIsActive(1)
	->whereIsCategory(1)
        ->select('id', 'code', 'name')
        ->get();
        return Response::json($item, 200);
    }

    public function actived_classification()
    {
        $item = Item::whereIsClassification(1)
        ->whereIsActive(1)
        ->select('id', 'code', 'name', 'category_id')
        ->get();
        return Response::json($item, 200);
    }

    public function actived_subclassification()
    {
        $item = Item::whereIsSubclassification(1)
        ->whereIsActive(1)
        ->select('id', 'code', 'name', 'classification_id')
        ->get();
        return Response::json($item, 200);
    }


    public function actived_generic()
    {
        $item = Item::whereIsGeneric(1)
        ->whereIsActive(1)
        ->select('id', 'code', 'name', 'subclassification_id')
        ->get();
        return Response::json($item, 200);
    }

    public function store_jenis_administrasi(Request $request) {
        DB::table('items')->insert([
            'code' => $request->code,
            'name' => $request->name,
            'is_cure' => 1,
            'is_category' => 1
        ]);

        return Response::json(['message' => 'Transaksi berhasil diinput'], 200);
    }

    public function store_classification(Request $request) {
        DB::table('items')->insert([
            'code' => $request->code,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'is_cure' => 1,
            'is_classification' => 1
        ]);

        return Response::json(['message' => 'Transaksi berhasil diinput'], 200);
    }

    public function store_subclassification(Request $request) {
        DB::table('items')->insert([
            'code' => $request->code,
            'name' => $request->name,
            'classification_id' => $request->classification_id,
            'is_cure' => 1,
            'is_subclassification' => 1
        ]);

        return Response::json(['message' => 'Transaksi berhasil diinput'], 200);
    }

    public function store_generic(Request $request) {
        DB::table('items')->insert([
            'code' => $request->code,
            'name' => $request->name,
            'subclassification_id' => $request->subclassification_id,
            'is_cure' => 1,
            'is_generic' => 1
        ]);

        return Response::json(['message' => 'Transaksi berhasil diinput'], 200);
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
        $item->is_cure = 1;
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
        $x = Item::with('group:id,name,code','classification:id,name,code', 'subclassification:id,name,code', 'generic:id,name,code', 'price:item_id,grup_nota_id', 'price.grup_nota:id,slug,name', 'piece:id,name', 'purchase_piece:id,name')->find($id);
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
            'grup_nota_id' => 'required'
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'grup_nota_id.required' => 'Grup nota tidak boleh kosong'
        ]);

        DB::beginTransaction();
        $item = Item::find($id);
        $item->fill($request->all());
        $item->price = $request->price ?? 0;
        $item->is_cure = 1;
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
