<?php

namespace App\Http\Controllers\Master;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = Contact::patient()->whereIsActive(1)->select('id', 'code', 'name')->get();
        return Response::json($contact, 200);
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
    public function store(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $family = new Contact();
        $family->fill($request->family);
        $family->is_contact = 1;
        $family->is_family = 1;
        $family->save();
        $insert = collect($request->all())->except('district_id', 'village_id')->toArray();
        $contact->fill($insert);
        $contact->district_id = $request->district_id;
        $contact->village_id = $request->village_id;
        $contact->contact_id = $family->id;
        $contact->family_id = $family->id;
        $contact->is_patient = 1;
        $contact->save();
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil diinput'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\piece  $contact
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::with('city.province', 'district', 'village', 'family:id,name,address,city_id,phone,job')->find($id);
        return Response::json($contact, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\piece  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\piece  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $contact = Contact::find($id);
        $family = (object) $request->family;
        $cp = Contact::firstOrCreate([
            'id' => $contact->contact_id
        ], [
            'name' => $family->name ?? null,
            'address' => $family->address ?? null,
            'city_id' => $family->city_id ?? null,
            'phone' => $family->phone ?? null,
            'job' => $family->job ?? null,
            'is_contact' => 1,
            'is_family' => 1
        ]);
        Contact::whereId($cp->id)->update([
           'name' => $family->name ?? null,
            'address' => $family->address ?? null,
            'city_id' => $family->city_id ?? null,
            'phone' => $family->phone ?? null,
            'job' => $family->job ?? null,
            'is_contact' => 1,
            'is_family' => 1
        ]);
        $contact->fill($request->all());
        $contact->contact_id = $cp->id;
        $contact->save();
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\piece  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $contact = Contact::find($id);
        $contact->is_active = 0;
        $contact->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }

    public function activate($id)
    {
        DB::beginTransaction();
        $contact = Contact::find($id);
        $contact->is_active = 1;
        $contact->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }
}
