<?php

namespace App\Http\Controllers\User;

use App\TreatmentGroup;
use App\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Response;
use DB;
use Str;
use Auth;
use Exception;

class TreatmentGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $treatmentGroup = TreatmentGroup::join('items', 'items.id', 'treatment_groups.item_id')
        ->select('items.id', 'items.name AS name')
        ->where('treatment_groups.is_active', 1)
        ->get();
        return Response::json($treatmentGroup, 200);
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'grup_nota_id' => 'required',
        ], [
            'grup_nota_id.required' => 'Grup nota tidak boleh kosong',
            'name.required' => 'Nama tidak boleh kosong',
            'price.required' => 'Harga tidak boleh kosong'
        ]);
        DB::beginTransaction();
        try {
            $treatmentGroup = new TreatmentGroup();
            $treatmentGroup->fill($request->all());
            $item = new Item();
            $item->is_treatment_group = 1;
            $item->name = $request->name;
            $item->code = date('tg') . rand(1, 999);
            $item->price = $request->price;
            $item->save();
            $treatmentGroup->item_id = $item->id;
            $treatmentGroup->save();
            $entries = 0;
            foreach($request->detail as $detail) {
                if(null != ($detail['item_id'] ?? null)) {
                    ++$entries;
                    $treatmentGroup->detail()->create($detail);
                }
            }
            if($entries == 0) {
                return Response::json(['message' => 'Detail barang tidak boleh kosong'], 500);
            }
        } catch(Exception $e) {
            return Response::json(['message' => $e->getMessage()], 421);
        }
        
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil diinput'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TreatmentGroup  $treatmentGroup
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $treatmentGroup = TreatmentGroup::with('grup_nota:id,slug,name', 'item:id,name,price', 'detail', 'detail.item:id,name')
        ->findOrFail($id);
        return Response::json($treatmentGroup, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TreatmentGroup  $treatmentGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(TreatmentGroup $treatmentGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TreatmentGroup  $treatmentGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $request->validate([
            'grup_nota' => 'required',
            'name' => 'required',
            'price' => 'required'
        ], [
            'grup_nota.required' => 'Grup nota tidak boleh tidak boleh kosong',
            'name.required' => 'Nama tidak boleh kosong',
            'price.required' => 'Harga tidak boleh kosong'
        ]);
        DB::beginTransaction();
        try {
            $treatmentGroup = TreatmentGroup::findOrFail($id);
            $treatmentGroup->fill($request->all());
            $item = Item::find($treatmentGroup->item_id);
            $item->name = $request->name;
            $item->price = $request->price;
            $item->save();
            $treatmentGroup->save();
            $entries = 0;
            // $treatmentGroup->detail()->delete();
            DB::table('treatment_group_details')
            ->whereTreatmentGroupId($id)
            ->delete();
            foreach($request->detail as $detail) {
                if(null != ($detail['item_id'] ?? null)) {
                    ++$entries;
                    $treatmentGroup->detail()->create($detail);
                }
            }
            if($entries == 0) {
                return Response::json(['message' => 'Detail barang tidak boleh kosong'], 500);
            }
        } catch(Exception $e) {
            return Response::json(['message' => $e->getMessage()], 421);
        }
        
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TreatmentGroup  $treatmentGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $treatmentGroup = TreatmentGroup::findOrFail($id);
        $treatmentGroup->is_active = 0;
        $treatmentGroup->item()->update([
            'is_active' => 0
        ]);
        $treatmentGroup->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }
    public function activate($id)
    {
        DB::beginTransaction();
        $treatmentGroup = TreatmentGroup::find($id);
        $treatmentGroup->is_active = 1;
        $treatmentGroup->item()->update([
            'is_active' => 1
        ]);
        $treatmentGroup->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }
}
