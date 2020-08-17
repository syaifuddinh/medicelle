<?php

namespace App\Http\Controllers\Pharmacy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PurchaseOrder;
use Response;
use PDF;

class PurchaseOrderController extends Controller
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
        $purchaseOrder = PurchaseOrder::with('detail', 'detail.item:id,name', 'supplier:id,name,address', 'purchase_request:id,code')->findOrFail($id);

        return $purchaseOrder;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchaseOrder = $this->fetch($id);
        return Response::json($purchaseOrder, 200);
    }

    public function pdf($id)
    {
        $purchaseOrder = $this->fetch($id);
        $grandtotal = 0;
        foreach ($purchaseOrder->detail as $d) {
            $grandtotal += $d->subtotal;
        }
        $params = [
            'purchaseOrder' => $purchaseOrder,
            'grandtotal' => $grandtotal,
        ];
        $pdf = PDF::loadview('pdf/pharmacy/purchase_order', $params);
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
