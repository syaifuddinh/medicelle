<?php

namespace App\Http\Controllers\Pharmacy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\EquipmentDetail;
use App\StockTransaction;
use App\Stock;
use DB;
use PDF;
use Response;
use Exception;
use Carbon\Carbon;

class EquipmentDetailController extends Controller
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
    }

    public function fetch($id) {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function approve($equipment_id, $id)
    {
        $equipmentDetail = EquipmentDetail::findOrFail($id);
        DB::beginTransaction();
        try {
            $equipmentDetail->is_approve = 1;
            $equipmentDetail->save();
            DB::commit();
        } catch(Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 421);
        }

        return response()->json(['message' => 'Data berhasil disetujui']);
    }
}
