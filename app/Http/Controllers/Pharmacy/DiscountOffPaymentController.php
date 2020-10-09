<?php

namespace App\Http\Controllers\Pharmacy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Payment;
use App\PaymentDetail;
use DB;
use PDF;
use Response;

class DiscountOffPaymentController extends Controller
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
            'contact_id' => 'required',
            'detail' => 'required',
        ], [
            'contact_id.required' => 'Principal tidak boleh kosong',
            'date.required' => 'Tanggal tidak boleh kosong',
            'detail.required' => 'Detail tidak boleh kosong'
        ]);

        DB::beginTransaction();
        try {
            $payment = new Payment();
            $payment->fill($request->all());
            $payment->is_discount_off = 1;
            $payment->save();
            $this->storeDetail($request->detail, $payment->id);
        } catch (Exception $e) {
            return Response::json(['message', $e->getMessage()], 500);
        }
        
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil di-input'], 200);
    }

    public function storeDetail($details, $id) {
        $payment = Payment::findOrFail($id);
        $payment->detail()->delete();
        collect($details)->each(function($val) use($id){
                $paymentDetail = new PaymentDetail();
                $paymentDetail->payment_id = $id;
                $paymentDetail->receipt_detail_id = $val['receipt_detail_id'];
                $paymentDetail->debet = 0;
                $paymentDetail->credit = $val['total_discount_value'];
                $paymentDetail->save();
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::with('detail', 'detail.item:id,name,price,piece_id', 'detail.item.piece:id,name', 'detail.lokasi:id,name', 'detail.stock:id,qty,expired_date', 'registration_detail:id,registration_id', 'medical_record:id,code', 'contributor:id,name')->findOrFail($id);
        return Response::json($payment, 200);
    }

    public function pdf($id)
    {
        $payment = Payment::with('detail', 'detail.item:id,name,price,piece_id', 'detail.item.piece:id,name', 'detail.lokasi:id,name', 'detail.stock:id,qty,expired_date', 'registration_detail:id,registration_id,doctor_id', 'registration_detail.doctor:id,name', 'medical_record:id,code')->findOrFail($id);
        $pdf = PDF::loadview('pdf/resep_obat',['formula'=>$payment]);
        return $pdf
        ->setPaper('A4')
        ->stream('resep-obat.pdf');
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
            $payment = Payment::findOrFail($id);
            $payment->fill($request->all());
            $payment->save();
            $payment->detail()->delete();
            foreach($request->detail as $detail) {
                if(null != ($detail['item_id'] ?? null)) {
                    $payment->detail()->create($detail);
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
        $payment = Payment::findOrFail($id);
        $payment->delete();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }

    public function approve($id)
    {
        //
        DB::beginTransaction();
        $payment = Payment::findOrFail($id);
        $payment->is_approve = 1;
        $payment->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil disetujui'], 200);
    }
}
