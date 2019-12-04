<?php

namespace App\Http\Controllers\Invoice;

use App\Invoice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoice = Invoice::whereStatus(2)->get();
        return Response::json($invoice, 200);
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
    public function store(Request $request, Invoice $invoice)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);
        return Response::json($invoice, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'name' => 'required|unique:Invoices,name,' . $invoice->id,
        ], [
            'name.unique' => 'Nama sudah digunakan',
            'name.required' => 'Nama tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $invoice->fill($request->all());
        $invoice->save();
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        // DB::beginTransaction();
        // $invoice->is_active = 0;
        // $invoice->save();
        // DB::commit();

        // return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }

    public function pay($id)
    {
        DB::beginTransaction();
        $invoice = Invoice::find($id);
        $invoice->is_active = 1;
        $invoice->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }
}
