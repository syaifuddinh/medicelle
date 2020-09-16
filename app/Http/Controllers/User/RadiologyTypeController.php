<?php

namespace App\Http\Controllers\User;

use App\RadiologyType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;
use Exception;

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
        try {
            $radiology_type->fill($request->all());
            $radiology_type->save();
            $rate = 0;
            foreach ($request->detail as $value) {
                if( null != ($value['name'] ?? null) ) {
                    $rate += ($value['price'] ?? 0);
                    $radiology_type->radiology_type_detail()->create([
                        'name' => $value['name'],
                        'price' => $value['price'] ?? 0
                    ]);
                }
            }
            $params = (array) $request->price;
            $params['price'] = $rate;
            $this->storePrice($radiology_type->id, $params);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 421);
        }
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
        $radiology_type = RadiologyType::with('radiology_type_detail:radiology_type_id,name,price', 'price', 'price.grup_nota:id,name', 'price.service:id,piece_id', 'price.service.piece:id,name')->find($id);
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
        $rate = 0;
        foreach ($request->detail as $value) {
            if( null != ($value['name'] ?? null)) {
                $rate += ($value['price'] ?? 0);
                $radiology_type->radiology_type_detail()->create([
                    'name' => $value['name'],
                    'price' => $value['price'] ?? 0
                ]);
            }
        }
        $request->price['price'] = $rate;
        $this->storePrice($radiology_type->id, $request->price);
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

    public function storePrice($radiology_type_id, $params = []) {
        $radiology_type = RadiologyType::find($radiology_type_id);
        $params = [
            'name' => $radiology_type->name,
            'is_diagnostic' => 1,
            'radiology_group' => $radiology_type_id,
            'grup_nota_id' => $params['grup_nota_id'],
            'piece_id' => $params['piece_id'],
            'price' => $params['price'],
            'percentage' => $params['percentage']
        ];
        $price = new \App\Http\Controllers\User\PriceController();
        if($radiology_type->price_id == null) {
            $price_id = $price->save(new Request($params));
            $radiology_type->price_id = $price_id;
            $radiology_type->save();
        } else {
            $price->put($radiology_type->price_id, new Request($params));
        }
    }
}
