<?php

namespace App\Http\Controllers\Pharmacy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Receipt;
use Response;
use DB;
use Exception;
use PDF;

class ReceiptController extends Controller
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
            'detail' => 'required',
        ], [
            'date.required' => 'Tanggal tidak boleh kosong',
            'detail.required' => 'Detail barang tidak boleh kosong'
        ]);

        DB::beginTransaction();
        try {
            $receipt = new Receipt();
            $receipt->fill($request->all());
            $receipt->save();

            $entries = 0;
            foreach($request->detail as $detail) {
                if(null != ($detail['item_id'] ?? null)) {
                    ++$entries;
                    $receipt->detail()->create($detail);
                }
            }
            if($entries == 0) {
                return Response::json(['message' => 'Detail barang tidak boleh kosong'], 500);
            }
        } catch (Exception $e) {
            return Response::json(['message' => $e->getMessage()], 421);
        }

        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil di-input'], 200);
    }

    public function fetch($id) {
        $receipt = Receipt::with('detail', 'detail.item:id,name','detail.purchase_order_detail:id,leftover_qty,received_qty,qty', 'supplier:id,name,address', 'purchase_order:id,code,purchase_request_id','purchase_order.purchase_request', 'purchase_order.purchase_request.approved', 'purchase_order.purchase_request.approved.user:id,name')->findOrFail($id);
        return $receipt;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $receipt = $this->fetch($id);
        return Response::json($receipt, 200);
    }

    public function pdf($id)
    {
        $receipt = $this->fetch($id);
        $grandtotal = 0;
        $hna_total = 0;
        foreach ($receipt->detail as $d) {
            $grandtotal += $d->subtotal;
            $hna_total += $d->hna;
        }
        $params = [
            'receipt' => $receipt,
            'grandtotal' => $grandtotal,
            'hna_total' => $hna_total,
            'dot' => '.......................'
        ];
        $pdf = PDF::loadview('pdf/pharmacy/receipt', $params);
        return $pdf->stream('Purchase order.pdf');
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
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

   
}
