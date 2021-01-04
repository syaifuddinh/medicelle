<?php

namespace App\Http\Controllers\Pharmacy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Equipment;
use DB;
use PDF;
use Response;
use Exception;

class EquipmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required'
        ], [
            'date.required' => 'Tanggal tidak boleh kosong'
        ]);
        DB::beginTransaction();
        try {
            $equipment = new Equipment();
            $equipment->fill($request->all());
            $equipment->save();

            $entries = 0;
            foreach($request->detail as $detail) {
                if(null != ($detail['item_id'] ?? null)) {
                    if(null == ($detail['lokasi_id'] ?? null)) {
                        throw new Exception('Lokasi tidak boleh kosong');
                    }
                    ++$entries;
                    $equipment->detail()->create($detail);
                }
            }
            if($entries == 0) {
                return Response::json(['message' => 'Detail barang tidak boleh kosong'], 500);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            return Response::json(['message' => $e->getMessage()], 421);
        }
        
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil di-input'], 200);
    }

    public function fetch($id) {
        $equipment = Equipment::with('detail', 'detail.item:id,name', 'detail.lokasi:id,name')->findOrFail($id);
        $approved = DB::table('equipment_details')
        ->whereEquipmentId($id)
        ->whereIsApprove(true)
        ->count('id');
        if($approved > 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        $equipment->status = $status;
        return $equipment;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipment = $this->fetch($id);
        return Response::json($equipment, 200);
    }

    public function pdf($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required'
        ], [
            'date.required' => 'Tanggal tidak boleh kosong'
        ]);
        DB::beginTransaction();
        try {
            $equipment = Equipment::findOrFail($id);
            $equipment->fill($request->all());
            $equipment->save();

            $entries = 0;
            $equipment->detail()->delete();
            foreach($request->detail as $detail) {
                if(null != ($detail['item_id'] ?? null)) {
                    if(null == ($detail['lokasi_id'] ?? null)) {
                        throw new Exception('Lokasi tidak boleh kosong');
                    }
                    ++$entries;
                    $equipment->detail()->create($detail);
                }
            }
            if($entries == 0) {
                return Response::json(['message' => 'Detail barang tidak boleh kosong'], 500);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            return Response::json(['message' => $e->getMessage()], 421);
        }
        
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil di-update'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::beginTransaction();
        $equipment = Equipment::findOrFail($id);
        if($equipment->status < 2) {
            $equipment->delete();
        } else {
            return Response::json(['message' => 'Transaksi yang sudah disetujui tidak dapat dihapus'], 421);
        }
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }
}
