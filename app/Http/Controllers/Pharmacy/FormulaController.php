<?php

namespace App\Http\Controllers\Pharmacy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Formula;
use DB;
use PDF;
use Response;

class FormulaController extends Controller
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
            'date' => 'required',
            'medical_record_id' => 'required',
            'detail' => 'required',
        ], [
            'medical_record_id.required' => 'No. rekam medis tidak boleh kosong',
            'date.required' => 'Tanggal tidak boleh kosong',
            'detail.required' => 'Detail barang tidak boleh kosong'
        ]);

        DB::beginTransaction();
        try {
            $formula = new Formula();
            $formula->fill($request->all());
            $formula->save();

            $entries = 0;
            foreach($request->detail as $detail) {
                if(null != ($detail['item_id'] ?? null)) {
                    ++$entries;
                    $formula->detail()->create($detail);
                }
            }
            if($entries == 0) {
                return Response::json(['message' => 'Detail barang tidak boleh kosong'], 500);
            }
        } catch (Exception $e) {
            return Response::json(['message', $e->getMessage()], 500);
        }
        
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil di-input'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $formula = Formula::with('detail', 'detail.item:id,name,price,piece_id', 'detail.item.piece:id,name', 'detail.lokasi:id,name', 'detail.stock:id,qty,expired_date', 'registration_detail:id,registration_id', 'medical_record:id,code', 'contributor:id,name')->findOrFail($id);
        return Response::json($formula, 200);
    }

    public function pdf($id)
    {
        $formula = Formula::with('detail', 'detail.item:id,name,price,piece_id', 'detail.item.piece:id,name', 'detail.lokasi:id,name', 'detail.stock:id,qty,expired_date', 'registration_detail:id,registration_id', 'medical_record:id,code')->findOrFail($id);
        $pdf = PDF::loadview('pdf/resep_obat',['formula'=>$formula]);
        return $pdf->stream('resep-obat.pdf');
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
            'date' => 'required',
            'medical_record_id' => 'required',
        ], [
            'medical_record_id.required' => 'No. rekam medis tidak boleh kosong',
            'date.required' => 'Tanggal sudah digunakan'
        ]);
        DB::beginTransaction();
        try {
            $formula = Formula::findOrFail($id);
            $formula->fill($request->all());
            $formula->save();
            $formula->detail()->delete();
            foreach($request->detail as $detail) {
                if(null != ($detail['item_id'] ?? null)) {
                    $formula->detail()->create($detail);
                }
            }
        } catch (Exception $e) {
            dd($e);
        }
        
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
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
        $formula = Formula::findOrFail($id);
        $formula->delete();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }

    public function approve($id)
    {
        //
        DB::beginTransaction();
        $formula = Formula::findOrFail($id);
        $formula->is_approve = 1;
        $formula->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil disetujui'], 200);
    }
}
