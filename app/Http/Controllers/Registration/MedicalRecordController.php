<?php

namespace App\Http\Controllers\Registration;

use App\MedicalRecord;
use App\MedicalRecordDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medical_record = MedicalRecord::with('patient:id,name')->get();
        return Response::json($medical_record, 200);
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
    public function store(Request $request, MedicalRecord $medical_record)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\medical_record  $medical_record
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $x = MedicalRecord::with(
            'patient:id,name', 
            'disease_history:medical_record_id,disease_id,cure,last_checkup_date', 
            'family_disease_history:medical_record_id,disease_id,cure,last_checkup_date', 
            'pain_history:medical_record_id,pain_location,is_other_pain_type,pain_type,pain_duration', 
            'pain_cure_history:medical_record_id,cure,emergence_time'
        )->find($id);
        return Response::json($x, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\medical_record  $medical_record
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicalRecord $medical_record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\medical_record  $medical_record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $medical_record = MedicalRecord::find($id);
        $medical_record->fill($request->all());
        $medical_record->save();

        $medical_record_detail = new MedicalRecordDetail();
        if(isset($request->pain_history)) {
            $medical_record_detail->pain_history()->whereMedicalRecordId($medical_record->id)->delete();
            $pain_history = collect($request->pain_history);
            $pain_history = $pain_history->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_pain_history = 1;
                $medical_record_detail->save();
            });
        }


        $medical_record_detail = new MedicalRecordDetail();
        if(isset($request->pain_cure_history)) {
            $medical_record_detail->pain_cure_history()->whereMedicalRecordId($medical_record->id)->delete();
            $pain_cure_history = collect($request->pain_cure_history);
            $pain_cure_history = $pain_cure_history->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_pain_cure_history = 1;
                $medical_record_detail->save();
            });
        }

        if(isset($request->disease_history)) {
            $medical_record_detail->disease_history()->whereMedicalRecordId($medical_record->id)->delete();
            $disease_history = collect($request->disease_history);
            $disease_history = $disease_history->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_disease_history = 1;
                $medical_record_detail->save();
            });
        }

        if(isset($request->family_disease_history)) {
            $medical_record_detail->family_disease_history()->whereMedicalRecordId($medical_record->id)->delete();
            $family_disease_history = collect($request->family_disease_history);
            $family_disease_history = $family_disease_history->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_family_disease_history = 1;
                $medical_record_detail->save();
            });
        }
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\medical_record  $medical_record
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $medical_record = MedicalRecord::find($id);
        $medical_record->is_active = 0;
        $medical_record->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }

    public function activate(MedicalRecord $medical_record)
    {
        DB::beginTransaction();
        $medical_record->is_active = 1;
        $medical_record->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }
}
