<?php

namespace App\Http\Controllers\Master;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contact = Contact::agency()->whereIsActive(1)->select('id', 'code', 'name');
        $contact = $request->filled('agency_type') ? $contact->whereAgencyType($request->agency_type) : $contact;
        $contact = $contact->get();
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
            'code' => 'required',
            'name' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'code.required' => 'Kode tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $cp = $contact->create([
            'name' => $request->contact_name,
            'is_contact' => 1
        ]);
        $contact->fill($request->all());
        $contact->contact_id = $cp->id;
        $contact->is_agency = 1;
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
        $contact = Contact::with('city.province', 'contact:id,name')->find($id);
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
            'code' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'code.required' => 'Kode tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $contact = Contact::find($id);

        $cp = Contact::firstOrCreate([
            'id' => $contact->contact_id
        ], [
            'name' => $request->contact_name,
            'is_contact' => 1
        ]);
        Contact::whereId($cp->id)->update(['name' => $request->contact_name]);
        $contact->fill($request->all());
        $contact->contact_id = $cp->id;
        $contact->save();
        $contact->fill($request->all());
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
