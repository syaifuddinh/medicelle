<?php

namespace App\Http\Controllers\Cashier;

use App\Invoice;
use App\InvoiceDetail;
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
        $invoice = Invoice::with('promo:invoice_id,total_credit', 'promo_info:id,code,name', 'massive_discount:invoice_id,total_credit')->find($id);
        $invoice_detail = InvoiceDetail::with(
            'item:id,name', 
            'grup_nota:permissions.id,name,slug',
            'reduksi_reference:id,invoice_detail_id,total_credit'
        )->select('id', 'item_id', 'qty', 'debet', 'credit', 'disc_percent')
        ->whereInvoiceId($id)
        ->whereIsItem(1)
        ->get();
        $invoice_detail = $invoice_detail->groupBy('grup_nota.name');
        $data = [
            'invoice' => $invoice,
            'invoice_detail' => $invoice_detail
        ];
        return Response::json($data, 200);
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
    public function update(Request $request, $id)
    {

        DB::beginTransaction();
        $invoice = Invoice::find($id);
        $invoice->fill($request->all());
        $invoice->gross = 0;
        $invoice->netto = 0;
        $invoice->qty = 0;
        $invoice->discount = 0;
        $invoice->save();
        InvoiceDetail::whereInvoiceId($invoice->id)->delete();
        collect($request->invoice_detail)->each(function($val) use($invoice){
            collect($val)->each(function($item) use ($invoice){
                $invoiceDetail = new InvoiceDetail();
                $invoiceDetail->invoice_id = $invoice->id;
                $invoiceDetail->item_id = $item['item_id'];
                $invoiceDetail->qty = $item['qty'];
                $invoiceDetail->debet = $item['debet'];
                $invoiceDetail->disc_percent = $item['disc_percent'];
                $invoiceDetail->is_item = 1;
                $invoiceDetail->save();
            });
        });
        $invoiceDetail = new InvoiceDetail();
        $invoiceDetail->invoice_id = $invoice->id;
        $invoiceDetail->qty = 1;
        $invoiceDetail->debet = 0;
        $invoiceDetail->credit = $request->massive_discount ?? 0;
        $invoiceDetail->is_discount_total  = 1;
        $invoiceDetail->save();
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

    public function pay(Request $request, $id)
    {
        
        DB::beginTransaction();
        $invoice = Invoice::find($id);
        $invoice->fill($request->all());
        $invoice->status = 2;
        $invoice->gross = 0;
        $invoice->netto = 0;
        $invoice->qty = 0;
        $invoice->discount = 0;
        $invoice->save();
        InvoiceDetail::whereInvoiceId($invoice->id)->delete();
        collect($request->invoice_detail)->each(function($val) use($invoice){
            collect($val)->each(function($item) use ($invoice){
                $invoiceDetail = new InvoiceDetail();
                $invoiceDetail->invoice_id = $invoice->id;
                $invoiceDetail->item_id = $item['item_id'];
                $invoiceDetail->qty = $item['qty'];
                $invoiceDetail->debet = $item['debet'];
                $invoiceDetail->disc_percent = $item['disc_percent'];
                $invoiceDetail->is_item = 1;
                $invoiceDetail->save();
            });
        });
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil terbayar'], 200);
    }
}
