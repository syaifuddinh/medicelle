<?php

namespace App\Http\Controllers\Registration;

use App\Registration;
use App\RegistrationDetail;
use App\Contact;
use App\Http\Controllers\Controller;
use App\City;
use Illuminate\Http\Request;
use Response;
use DB;
use Exception;

class RegistrationController extends Controller
{
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
        $registration->pic_id = $request->patient_type == 'UMUM'? $request->family['id'] : $request->agency_id;
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
        $registration = Registration::find($id);
        $registration->status = 2;
        $registration->save();
        DB::commit();

        return Response::json(['message' => 'Status pasien saat ini adalah telah hadir'], 200);
    }

    public function finish($registration_detail_id)
    {
        DB::beginTransaction();
        try {
            $registration = RegistrationDetail::findOrFail($registration_detail_id);
            $registration->status = 1;
            $registration->save();
        } catch (Exception $e) {
            return Response::json(['message' => $e->getMessage()], 421);
        }
        DB::commit();

        return Response::json(['message' => 'Pemeriksaan sudah selesai'], 200);
    }
}
