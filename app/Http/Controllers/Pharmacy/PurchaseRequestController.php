<?php

namespace App\Http\Controllers\Pharmacy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\PurchaseRequest;
use DB;
use PDF;
use Response;
use Exception;

class PurchaseRequestController extends Controller
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
            'date_start' => 'required',
            'date_end' => 'required',
            'detail' => 'required',
        ], [
            'date.required' => 'Tanggal tidak boleh kosong',
            'date_start.required' => 'Periode awal tidak boleh kosong',
            'date_end.required' => 'Periode akhir tidak boleh kosong',
            'detail.required' => 'Detail barang tidak boleh kosong'
        ]);

        DB::beginTransaction();
        try {
            $purchaseRequest = new PurchaseRequest();
            $purchaseRequest->fill($request->all());
            $purchaseRequest->save();

            $entries = 0;
            foreach($request->detail as $detail) {
                if(null != ($detail['item_id'] ?? null)) {
                    if(null == ($detail['supplier_id'] ?? null)) {
                        return Response::json(['message' => 'Supplier tidak boleh kosong'], 500);
                    }
                    ++$entries;
                    $purchaseRequest->detail()->create($detail);
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

    public function fetch($id) {
        $purchaseRequest = PurchaseRequest::with('detail', 'detail.item:id,name', 'detail.supplier:id,name')->findOrFail($id);

        return $purchaseRequest;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchaseRequest = $this->fetch($id);
        return Response::json($purchaseRequest, 200);
    }

    public function pdf($id)
    {
        $purchaseRequest = $this->fetch($id);
        $grandtotal = 0;
        foreach ($purchaseRequest->detail as $d) {
            $grandtotal += $d->subtotal;
        }
        $params = [
            'purchaseRequest' => $purchaseRequest,
            'grandtotal' => $grandtotal,
        ];
        $pdf = PDF::loadview('pdf/pharmacy/purchase_request', $params);
        return $pdf->stream('Purchase request.pdf');
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
        ], [
            'date.required' => 'Tanggal sudah digunakan'
        ]);
        DB::beginTransaction();
        try {
            $purchaseRequest = PurchaseRequest::findOrFail($id);
            $purchaseRequest->fill($request->all());
            $purchaseRequest->save();
            $purchaseRequest->detail()->delete();
            foreach($request->detail as $detail) {
                if(null != ($detail['item_id'] ?? null)) {
                    if(null == ($detail['supplier_id'] ?? null)) {
                        return Response::json(['message' => 'Supplier tidak boleh kosong'], 500);
                    }
                    $purchaseRequest->detail()->create($detail);
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
        $purchaseRequest = PurchaseRequest::findOrFail($id);
        if($purchaseRequest->status < 2) {
            $purchaseRequest->delete();
        } else {
            return Response::json(['message' => 'Transaksi yang sudah disetujui tidak dapat dihapus'], 421);
        }
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }

    public function approve($id)
    {
        DB::beginTransaction();
        $purchaseRequest = PurchaseRequest::findOrFail($id);
        try {
            if($purchaseRequest->status < 4) {        
                if(auth()->user()->is_admin != 1) {
                    $contact_id = auth()->user()->contact_id;
                    if($contact_id == null) {
                        throw new Exception('Anda tidak diizinkan untuk melakukan approval');
                    }
                    $setting = \App\Http\Controllers\User\SettingController::fetch('pic');
                    $status = $purchaseRequest->status;
                    if($status == 1) {
                        $pharmacy = $setting->pharmacy;
                        if(!in_array($contact_id, $pharmacy)) {
                            throw new Exception('Anda tidak diizinkan untuk melakukan approval');
                        }
                    } else if($status == 2) {
                        $purchase_request_approval = $setting->purchase_request_approval;
                        if(!in_array($contact_id, $purchase_request_approval)) {
                            throw new Exception('Anda tidak diizinkan untuk melakukan approval');
                        }
                    } else if($status == 3) {
                        $purchase_order_approval = $setting->purchase_order_approval;
                        if(!in_array($contact_id, $purchase_order_approval)) {
                            throw new Exception('Anda tidak diizinkan untuk melakukan approval');
                        }
                    }
                }
                $purchaseRequest->status += 1;
                $purchaseRequest->save();
                DB::commit();
            } else {
                throw new Exception('Status tidak dapat di-update lagi');
            }

        } catch (Exception $e) {
            DB::rollback();
            return Response::json(['message' => $e->getMessage()], 421);
        }

        return Response::json(['message' => 'Data berhasil disetujui'], 200);
    }

    public function rollback($id)
    {
        DB::beginTransaction();
        $purchaseRequest = PurchaseRequest::findOrFail($id);
        if($purchaseRequest->status > 1) {        
            $purchaseRequest->status -= 1;
            $purchaseRequest->save();
        } else {
            return Response::json(['message' => 'Status tidak dapat di-update lagi'], 421);
        }
        DB::commit();

        return Response::json(['message' => 'Data berhasil disetujui'], 200);
    }
}
