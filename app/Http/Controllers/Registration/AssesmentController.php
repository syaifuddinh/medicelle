<?php

namespace App\Http\Controllers\Registration;

use App\Assesment;
use App\AssesmentDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;

class AssesmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assesment = Assesment::with('patient:id,name')->get();
        return Response::json($assesment, 200);
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
    public function store(Request $request, Assesment $assesment)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\assesment  $assesment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $x = Assesment::with(
            'patient:id,name', 
            'disease_history:assesment_id,disease_id,cure,last_checkup_date', 
            'family_disease_history:assesment_id,disease_id,cure,last_checkup_date', 
            'pain_history:assesment_id,pain_location,is_other_pain_type,pain_type,pain_duration', 
            'allergy_history:assesment_id,cure,side_effect', 
            'pain_history:assesment_id,pain_location,is_other_pain_type,pain_type,pain_duration', 
            'pain_cure_history:assesment_id,cure,emergence_time',
            'kid_history:assesment_id,is_pregnant_week_age,kid_order,partus_year,partus_location,pregnant_month_age,pregnant_week_age,birth_type,birth_helper,birth_obstacle,weight,long,komplikasi_nifas,baby_gender',
            'imunisasi_history:assesment_id,is_other_imunisasi,imunisasi_year_age,imunisasi_month_age,is_imunisasi_month_age,imunisasi,reaksi_imunisasi'
        )->find($id);
        return Response::json($x, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\assesment  $assesment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assesment $assesment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\assesment  $assesment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $assesment = Assesment::findOrFail($id);
        $assesment->fill($request->all());
        $assesment->save();

        $assesment_detail = new AssesmentDetail();
        if(isset($request->kid_history)) {
            $assesment_detail->kid_history()->whereAssesmentId($assesment->id)->delete();
            $kid_history = collect($request->kid_history);
            $kid_history = $kid_history->each(function($val) use($assesment){
                $assesment_detail = new AssesmentDetail();
                $val['assesment_id'] = $assesment->id;
                $assesment_detail->fill($val);
                $assesment_detail->is_kid_history = 1;
                $assesment_detail->save();
            });
        }


        $assesment_detail = new AssesmentDetail();
        if(isset($request->imunisasi_history)) {
            $assesment_detail->imunisasi_history()->whereAssesmentId($assesment->id)->delete();
            $imunisasi_history = collect($request->imunisasi_history);
            $imunisasi_history = $imunisasi_history->each(function($val) use($assesment){
                $assesment_detail = new AssesmentDetail();
                $val['assesment_id'] = $assesment->id;
                $assesment_detail->fill($val);
                $assesment_detail->is_imunisasi_history = 1;
                $assesment_detail->save();
            });
        }


        $assesment_detail = new AssesmentDetail();
        if(isset($request->pain_history)) {
            $assesment_detail->pain_history()->whereAssesmentId($assesment->id)->delete();
            $pain_history = collect($request->pain_history);
            $pain_history = $pain_history->each(function($val) use($assesment){
                $assesment_detail = new AssesmentDetail();
                $val['assesment_id'] = $assesment->id;
                $assesment_detail->fill($val);
                $assesment_detail->is_pain_history = 1;
                $assesment_detail->save();
            });
        }


        $assesment_detail = new AssesmentDetail();
        if(isset($request->pain_cure_history)) {
            $assesment_detail->pain_cure_history()->whereAssesmentId($assesment->id)->delete();
            $pain_cure_history = collect($request->pain_cure_history);
            $pain_cure_history = $pain_cure_history->each(function($val) use($assesment){
                $assesment_detail = new AssesmentDetail();
                $val['assesment_id'] = $assesment->id;
                $assesment_detail->fill($val);
                $assesment_detail->is_pain_cure_history = 1;
                $assesment_detail->save();
            });
        }

        if(isset($request->disease_history)) {
            $assesment_detail->disease_history()->whereAssesmentId($assesment->id)->delete();
            $disease_history = collect($request->disease_history);
            $disease_history = $disease_history->each(function($val) use($assesment){
                $assesment_detail = new AssesmentDetail();
                $val['assesment_id'] = $assesment->id;
                $assesment_detail->fill($val);
                $assesment_detail->is_disease_history = 1;
                $assesment_detail->save();
            });
        }

        if(isset($request->family_disease_history)) {
            $assesment_detail->family_disease_history()->whereAssesmentId($assesment->id)->delete();
            $family_disease_history = collect($request->family_disease_history);
            $family_disease_history = $family_disease_history->each(function($val) use($assesment){
                $assesment_detail = new AssesmentDetail();
                $val['assesment_id'] = $assesment->id;
                $assesment_detail->fill($val);
                $assesment_detail->is_family_disease_history = 1;
                $assesment_detail->save();
            });
        }

        if(isset($request->allergy_history)) {
            $assesment_detail->allergy_history()->whereAssesmentId($assesment->id)->delete();
            $allergy_history = collect($request->allergy_history);
            $allergy_history = $allergy_history->each(function($val) use($assesment){
                $assesment_detail = new AssesmentDetail();
                $val['assesment_id'] = $assesment->id;
                $assesment_detail->fill($val);
                $assesment_detail->is_allergy_history = 1;
                $assesment_detail->save();
            });
        }
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\assesment  $assesment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $assesment = Assesment::find($id);
        $assesment->is_active = 0;
        $assesment->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }
    public function clone($destination_id, $origin_id)
    {
        DB::beginTransaction();
        $origin_assesment = Assesment::find($origin_id)->toArray();
        $origin_assesment = collect($origin_assesment)
        ->except( 'patient_id')
        ->toArray();        

        $destination_assesment = Assesment::find($destination_id);
        $destination_assesment->fill($origin_assesment);
        $destination_assesment->save();
        $origin_assesment_detail = AssesmentDetail::whereAssesmentId($origin_id)->get()->toArray();
        $origin_assesment_detail = collect($origin_assesment_detail)
        ->each(function($val) use($destination_id){
            $val['assesment_id'] =$destination_id;
            $destination_assesment_detail = new AssesmentDetail();
            $destination_assesment_detail->fill($val);
            $destination_assesment_detail->save();
        })
        ->toArray();
        DB::commit();

        return Response::json(['message' => 'Assesment berhasil disalin'], 200);
    }

    public function activate(Assesment $assesment)
    {
        DB::beginTransaction();
        $assesment->is_active = 1;
        $assesment->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }
}
