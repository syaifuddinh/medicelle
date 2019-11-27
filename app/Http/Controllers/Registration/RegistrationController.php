<?php

namespace App\Http\Controllers\Registration;

use App\Registration;
use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registration = Registration::whereRaw('1=1')->select('id', 'code', 'name')->get();
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Registration $registration)
    {
        DB::beginTransaction();

        // Validasi pasien
        if(!array_key_exists('id', $request->patient)) {
            $patient = new Contact();
            $patient->fill($request->patient);
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
                $family->save();
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
        $registration = Registration::with('city.province', 'registration:id,name')->find($id);
        return Response::json($registration, 200);
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
            'name' => 'required',
            'code' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'code.required' => 'Kode tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $registration = Registration::find($id);

        $cp = Registration::firstOrCreate([
            'id' => $registration->registration_id
        ], [
            'name' => $request->registration_name,
            'is_registration' => 1
        ]);
        Registration::whereId($cp->id)->update(['name' => $request->registration_name]);
        $registration->fill($request->all());
        $registration->registration_id = $cp->id;
        $registration->save();
        $registration->fill($request->all());
        $registration->save();
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
}
