<?php

namespace App\Http\Controllers\Registration;

use App\Registration;
use App\RegistrationDetail;
use App\InvoiceDetail;
use App\Contact;
use App\Http\Controllers\Controller;
use App\City;
use Illuminate\Http\Request;
use Response;
use DB;
use Exception;

class RegistrationController extends Controller
{
    public function __construct(\App\Invoice $invoice, \App\PivotMedicalRecord $pivot_medical_record, \Carbon\Carbon $carbon, \App\Formula $formula) {
        $this->invoice = $invoice;
        $this->pivot_medical_record = $pivot_medical_record;
        $this->carbon = $carbon;
        $this->formula = $formula;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registration = Registration::whereRaw('1=1')->select('id', 'code')->get();
        return Response::json($registration, 200);
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

    public function store_city($id, $province_id) {
        if(!preg_match('/^(\d+)$/', $id)) {
            $c = new City();
            $c->name = $id;
            $c->province_id = $province_id ;
            $c->type = 'kabupaten';
            $c->save();
            return $c->id;
        } else {
            return $id;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Registration $registration)
    {
        $request->validate([
            'patient.name' => 'required',
            'patient.gender' => 'required',
            'detail' => 'required',
        ], [
            'patient.name.required' => 'Pasien tidak boleh kosong',
            'patient.gender.required' => 'Jenis kelamin tidak boleh kosong',
            'detail.required' => 'Detail tidak boleh kosong'
        ]);
        DB::beginTransaction();

        // Validasi pasien
        if(!array_key_exists('id', $request->patient)) {
            $patient = new Contact();
            $city_id = $this->store_city($request->patient['city_id'], $request->patient['province_id'] ?? null);
            $patient->city_id = $city_id;   
            $patient->fill(collect($request->patient)->except('city_id')->toArray());
            $patient->is_patient = 1;
            $patient->save();
            $patient_id = $patient->id;
        } else {
            $patient_id = $request->patient['id'];
        }

        // Validasi keluarga pasien
        if($request->patient_type == 'UMUM') {
            if(!array_key_exists('id', $request->patient['family'])) {
                $family = new Contact();
                $family->fill($request->patient['family']);
                $family->is_contact = 1;
                $family->is_family = 1;
                $family->save();
                $patient = Contact::find($patient_id);
                $patient->contact_id = $family->id;
                $patient->save();
            } else {
                $family = Contact::find($request->patient['family']['id']);
                $family->fill($request->patient['family']);
                $family->save();
            }
        }

        $registration->fill($request->all());
        $registration->patient_id = $patient_id;
        $registration->pic_id = $request->patient_type == 'UMUM'? ($request->family['id'] ?? null) : $request->agency_id;
        $registration->save();
        $detail = collect($request->detail);
        $detail = $detail->each(function($val) use($registration){
            $val['registration_id'] = $registration->id;
            $registrationDetail = new RegistrationDetail();
            $registrationDetail->fill($val);
            $registrationDetail->save();
        });
        
        DB::commit();   
        
        return Response::json(['message' => 'Transaksi berhasil diinput'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\piece  $registration
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $registration = Registration::with(
            'patient.family', 'patient.city', 'patient.city.province', 
            'pic:id,name', 
            'detail', 
            'medical_record:id,code',
            'invoice:registration_id,status',
            'assesment:id,registration_id'
        )->find($id);
        return Response::json($registration, 200);
    }

    public function detail($registration_id, $registration_detail_id)
    {
        $registration = Registration::findOrFail($registration_id);
        $registrationDetail = RegistrationDetail::findOrFail($registration_detail_id);
        return Response::json($registrationDetail, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\piece  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\piece  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'patient.name' => 'required',
            'detail' => 'required',
        ], [
            'patient.name.required' => 'Pasien tidak boleh kosong',
            'detail.required' => 'Detail tidak boleh kosong'
        ]);
        DB::beginTransaction();
        $registration = Registration::find($id);
        // Validasi pasien
        if(!array_key_exists('id', $request->patient)) {
            $patient = new Contact();
            $city_id = $this->store_city($request->patient['city_id'], $request->patient['province_id'] ?? null);
            $patient->city_id = $city_id;
            $patient->fill(collect($request->patient)->except('city_id')->toArray());
            $patient->is_patient = 1;
            $patient->save();
            $patient_id = $patient->id;
        } else {
            $patient_id = $request->patient['id'];
        }

        // Validasi keluarga pasien
        if($request->patient_type == 'UMUM') {
            if(!array_key_exists('id', $request->patient['family'])) {
                $family = new Contact();
                $family->fill($request->patient['family']);
                $family->is_contact = 1;
                $family->is_family = 1;
                $family->save();
                $patient = Contact::find($patient_id);
                $patient->contact_id = $family->id;
                $patient->save();
            } else {
                $family = Contact::find($request->patient['family']['id']);
                $family->fill($request->patient['family']);
                $family->save();
            }
        }

        $registration->fill($request->all());
        $registration->patient_id = $patient_id;
        $registration->pic_id = $request->patient_type == 'UMUM'? $request->family['id'] : $request->agency_id;
        $registration->save();
        // Update detail
        RegistrationDetail::whereRegistrationId($id)->delete();
        $detail = collect($request->detail);
        $detail = $detail->each(function($val) use($registration){
            $val['registration_id'] = $registration->id;
            $registrationDetail = new RegistrationDetail();
            $registrationDetail->fill($val);
            $registrationDetail->save();
        });
        
        DB::commit(); 

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\piece  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $registration = Registration::find($id);
        $registration->status = 3;
        $registration->save();
        DB::commit();

        return Response::json(['message' => 'Status pasien saat ini adalah dibatalkan'], 200);
    }

    public function attend($id)
    {
        DB::beginTransaction();
        try {
            $registration = Registration::find($id);
            $registration->status = 2;
            $registration->save();
            DB::commit();
        } catch (Exception $e) {
            return Response::json(['message' => $e->getMessage()], 421);
        }

        return Response::json(['message' => 'Status pasien saat ini adalah telah hadir'], 200);
    }

    public function finish($registration_detail_id)
    {
        DB::beginTransaction();
        try {
            $registration = RegistrationDetail::findOrFail($registration_detail_id);
            $registration->status = 1;
            $registration->save();
            $this->storeFormula($registration_detail_id);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            dd($e);
            return Response::json(['message' => $e->getMessage()], 421);
        }

        return Response::json(['message' => 'Pemeriksaan sudah selesai'], 200);
    }

    public function storeInvoice($registration_detail_id) {
        $registrationDetail = RegistrationDetail::findOrFail($registration_detail_id);
        
                $medical_record = DB::table('medical_records')
                ->whereRegistrationDetailId($registrationDetail->id)
                ->first();
                if($medical_record == null) {
                    $medical_record = DB::table('medical_records')
                    ->whereRegistrationDetailId($registrationDetail->medical_record_refer_id)
                    ->first();                    
                    $registrationDetail->id = $registrationDetail->medical_record_refer_id;
                    if($medical_record == null) {
                        throw new Exception('Rekam medis tidak ditemukan');
                    }
                } 
                $this->pivot_medical_record->where('registration_detail_id', '!=', $registrationDetail->id)->whereMedicalRecordId($medical_record->id)->delete();
                
                    $registration = $registrationDetail->registration;
                    $invoice = new $this->invoice();
                    $invoice->is_nota_pemeriksaan = 1;
                    $invoice->payment_method = 'TUNAI';
                    $invoice->date = $this->carbon->now()->format('Y-m-d');
                    if($registration->patient_type == 'ASURANSI SWASTA') {
                        $invoice->payment_type = 'ASURANSI SWASTA';                        
                    } else {
                        $invoice->payment_type = 'BAYAR SENDIRI';                        
                    }
                    $invoice->registration_id = $registration->id;
                    $invoice->save();
                
                $medicalRecord = $registrationDetail->medical_record;
                $treatments = $medicalRecord->treatment;
                $treatment_groups = $medicalRecord->treatment_group;
                $diagnostics = $medicalRecord->diagnostic;
                $bhp = $medicalRecord->bhp;
                $sewa_ruangan = $medicalRecord->sewa_ruangan;
                $sewa_alkes = $medicalRecord->sewa_alkes;
                $sewa_instrumen = $medicalRecord->sewa_instrumen;
                $drug = $medicalRecord->drug;
                DB::beginTransaction();
                foreach($treatments as $value) {
                    InvoiceDetail::create([
                        'invoice_id' => $invoice->id,
                        'item_id' => $value->item_id,
                        'qty' => $value->qty,
                        'is_item' => 1,
                        'is_profit_sharing' => 1,
                        'debet' => $value->item->price,
                        'reduksi' => $value->reduksi
                    ]);
                }
                foreach($treatment_groups as $value) {
                    InvoiceDetail::create([
                        'invoice_id' => $invoice->id,
                        'item_id' => $value->item_id,
                        'qty' => $value->qty,
                        'is_item' => 1,
                        'is_profit_sharing' => 1,
                        'debet' => $value->item->price,
                        'reduksi' => $value->reduksi
                    ]);
                }
                foreach($diagnostics as $value) {
                    if($value->laboratory_pivot !== null) {
                        $price = 0;
                        $service_price = 0;
                        $item_id = null;
                        if(($value->laboratory_pivot->additional ?? null)) {
                            foreach($value->laboratory_pivot->additional->treatment as $treatment) {                        
                                foreach($treatment->detail as $detail) {
                                    $laboratoryTypeDetail = DB::table('laboratory_type_details')
                                    ->whereId($detail->id)
                                    ->first();
                                    if($laboratoryTypeDetail) {
                                        if(!$laboratoryTypeDetail->item_id) {
                                            $item_id = DB::table('items')
                                            ->insertGetId([
                                                'code' => 'LABORATORYTYPEDETAIL' . date('YmdHis'),
                                                'name' => $laboratoryTypeDetail->name,
                                                'price' => $laboratoryTypeDetail->price,
                                                'service_price' => $laboratoryTypeDetail->service_price,
                                                'is_laboratory_type_detail' => 1
                                            ]);
                                            DB::table('laboratory_type_details')
                                            ->whereId($detail->id)
                                            ->update([
                                                'item_id' => $item_id
                                            ]);
                                        } else {
                                            $item_id = $laboratoryTypeDetail->item_id; 
                                        }
                                        $price = $laboratoryTypeDetail->price;
                                        $service_price = $laboratoryTypeDetail->service_price;
                                        InvoiceDetail::create([
                                            'invoice_id' => $invoice->id,
                                            'item_id' => $item_id,
                                            'is_profit_sharing' => 1,
                                            'qty' => $value->qty,
                                            'is_item' => 1,
                                            'debet' => $price,
                                            'reduksi' => $value->reduksi,
                                            'service_price' => $service_price
                                        ]);
                                    }
                                }
                            }
                        }
                    } else {
                        $debet = 0;
                        $additional = $value->laboratory_pivot->additional;
                        if(($additional->treatment ?? null)) {
                            if(count($additional->treatment) > 0) {
                                foreach($additional->treatment as $t) {
                                    foreach ($t->detail as $recover) {
                                        $laboratory_type_detail = DB::table('laboratory_type_details')
                                        ->whereId($recover->id)
                                        ->first();
                                        if($laboratory_type_detail != null) {
                                            $debet += $laboratory_type_detail->price;
                                        }
                                    }
                                }
                            }
                        }
                        InvoiceDetail::create([
                            'invoice_id' => $invoice->id,
                            'item_id' => $value->item_id,
                            'is_profit_sharing' => 1,
                            'qty' => $value->qty,
                            'is_item' => 1,
                            'debet' => $debet,
                            'reduksi' => $value->reduksi
                        ]);                        
                    }
                }
                foreach($bhp as $value) {
                    InvoiceDetail::create([
                        'invoice_id' => $invoice->id,
                        'item_id' => $value->item_id,
                        'qty' => $value->qty,
                        'is_item' => 1,
                        'debet' => $value->item->price,
                    ]);
                }
                foreach($sewa_ruangan as $value) {
                    InvoiceDetail::create([
                        'invoice_id' => $invoice->id,
                        'item_id' => $value->item_id,
                        'qty' => $value->qty,
                        'is_item' => 1,
                        'debet' => $value->item->price,
                    ]);
                }
                foreach($sewa_alkes as $value) {
                    InvoiceDetail::create([
                        'invoice_id' => $invoice->id,
                        'item_id' => $value->item_id,
                        'qty' => $value->qty,
                        'is_item' => 1,
                        'debet' => $value->item->price,
                    ]);
                }
                foreach($sewa_instrumen as $value) {
                    InvoiceDetail::create([
                        'invoice_id' => $invoice->id,
                        'item_id' => $value->item_id,
                        'qty' => $value->qty,
                        'is_item' => 1,
                        'debet' => $value->item->price,
                    ]);
                }

                DB::commit();

            

        return Response::json(['message' => 'Invoice berhasil dibuat', 'data' => ['id' => $invoice->id]]);
    }

    public function storeFormula($registration_detail_id) {
        $registrationDetail = RegistrationDetail::findOrFail($registration_detail_id);
        
                $medical_record = DB::table('medical_records')
                ->whereRegistrationDetailId($registrationDetail->id)
                ->first();
                if($medical_record == null) {
                    $medical_record = DB::table('medical_records')
                    ->whereRegistrationDetailId($registrationDetail->medical_record_refer_id)
                    ->first();                    
                    $registrationDetail->id = $registrationDetail->medical_record_refer_id;
                    if($medical_record == null) {
                        throw new Exception('Rekam medis tidak ditemukan');
                    }
                } 
                
                $medicalRecord = $registrationDetail->medical_record;
                $drug = $medicalRecord->drug;
                // Generate resep obat 
                if($medicalRecord->drug()->count('id') > 0) {
                    $formula = $this->formula->create([
                        'medical_record_id' => $medicalRecord->id,
                        'registration_detail_id' => $registrationDetail->id,
                        'date' => $this->carbon->now()->format('Y-m-d')

                    ]);
                    foreach($drug as $value) {
                        $stock = DB::table('stocks')
                        ->whereItemId($value->item_id)
                        ->whereRaw('NOW() < expired_date')
                        ->first();

                        if($stock == null) {
                            $item = DB::table('items')
                            ->whereId($value->item_id)
                            ->select('name')
                            ->first();
                            throw new Exception('Stok ' . $item->name . '  tidak tersedia');
                        } else {
                            $formula->detail()->create([
                                'item_id' => $value->item_id,
                                'qty' => $value->qty,
                                'lokasi_id' => $stock->lokasi_id,
                                'stock_id' => $stock->id,
                            ]);
                        }
                    }
                }
    }
}
