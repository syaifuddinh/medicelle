<?php

namespace App\Http\Controllers\Registration;

use App\MedicalRecord;
use App\MedicalRecordDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Mod;
use Response;
use DB;
use Str;
use File;
use PDF;

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
    public function schedule($id) {
        $medicalRecord = MedicalRecord::findOrFail($id);
        $medicalRecordDetail = MedicalRecordDetail::with('medical_record:id,registration_id,registration_detail_id', 'medical_record.registration:id,code,patient_type', 'medical_record.registration_detail:id,doctor_id,polyclinic_id,destination', 'medical_record.registration_detail.doctor:id,name,specialization_id', 'medical_record.registration_detail.doctor.specialization:id,name')
        ->whereMedicalRecordId($id)
        ->whereIsSchedule(1)
        ->select('id', 'medical_record_id', 'date')
        ->get();
        return Response::json($medicalRecordDetail, 200);
    }

    public function refer_doctor($id, $doctor_id) {
        $medicalRecord = MedicalRecord::findOrFail($id);
        $medicalRecord->refer_doctor_id = $doctor_id;
        $medicalRecord->save();
        return Response::json(['message' => 'Dokter rujukan telah dipilih'], 200);
    }
    public function doctor($id) {
        $medicalRecord = MedicalRecord::findOrFail($id);
        $doctor = $medicalRecord->registration_detail->doctor;
        $refer_doctor = $medicalRecord->refer_doctor;
        $resp = [
            'doctor' => [
                'id' => $doctor->id,
                'name' => $doctor->name,
                'specialization' => [
                    'name' =>  $doctor->specialization->name
                ]
            ],
            'refer_doctor' => [
                'id' => $refer_doctor->name ?? null,
                'name' => $refer_doctor->name ?? null
            ]
        ];
        return Response::json($resp, 200);
    }

    public function next_schedule($id) {
        $medicalRecord = MedicalRecord::findOrFail($id);
        $resp = [
            'date' => $medicalRecord->next_schedule->date ?? null
        ];
        return Response::json($resp, 200);
    }

    public function fetch($id) {
        $resp = MedicalRecord::with(
            'patient:id,name', 
            'bhp:medical_record_id,item_id,qty,date,lokasi_id',
            'bhp.item:id,name,piece_id',
            'bhp.item.piece:id,name',
            'bhp.lokasi:id,name',
            'sewa_alkes:medical_record_id,item_id,qty,date,lokasi_id',
            'sewa_alkes.item:id,name,piece_id',
            'sewa_alkes.item.piece:id,name',
            'sewa_alkes.lokasi:id,name',
            'sewa_ruangan:medical_record_id,item_id,qty,date,lokasi_id',
            'sewa_ruangan.item:id,name,piece_id',
            'sewa_ruangan.item.piece:id,name',
            'sewa_ruangan.lokasi:id,name',
            'radiology:id,medical_record_id,date,result_date,name,description,is_radiology,saran,kesimpulan,kanan,kiri',
            'laboratory:id,medical_record_id,date,result_date,name,description,is_laboratory,saran,kesimpulan,kanan,kiri',
            'pathology:id,medical_record_id,date,result_date,name,description,is_pathology',
            'diagnose_history:medical_record_id,disease_id,type,description',

            'disease_history:medical_record_id,disease_name,cure,last_checkup_date',
            'obgyn_disease_history:medical_record_id,disease_name,cure,last_checkup_date',

            'family_disease_history:medical_record_id,disease_name,description', 
            'obgyn_family_disease_history:medical_record_id,disease_name,cure,last_checkup_date', 

            'kb_history:medical_record_id,name,duration', 
            'komplikasi_kb_history:medical_record_id,name', 

            'ginekologi_history:medical_record_id,name', 

            'treatment:medical_record_id,item_id,date,qty,reduksi', 
            'diagnostic:medical_record_id,item_id,date,qty,reduksi', 
            'drug:medical_record_id,item_id,date,qty,signa1,signa2', 
            'drug.item:id,name,piece_id',
            'drug.item.piece:id,name',

            'pain_history:medical_record_id,pain_location,is_other_pain_type,pain_type,pain_duration', 
            
            'allergy_history:medical_record_id,cure,side_effect', 
            'pain_history:medical_record_id,pain_location,is_other_pain_type,pain_type,pain_duration', 
            'pain_cure_history:medical_record_id,cure,emergence_time',
            'kid_history:medical_record_id,is_pregnant_week_age,kid_order,partus_year,partus_location,pregnant_month_age,pregnant_week_age,birth_type,birth_helper,birth_obstacle,weight,long,komplikasi_nifas,baby_gender',
            'imunisasi_history:medical_record_id,is_other_imunisasi,imunisasi_year_age,imunisasi_month_age,is_imunisasi_month_age,imunisasi,reaksi_imunisasi'
        )->findOrFail($id);

        return $resp;
    }

    public function show($id)
    {

        $x = $this->fetch($id);
        return Response::json($x, 200);
    }

    public function pdf(Request $request, $id)
    {
        $medicalRecord = $this->fetch($id);
        $date = $request->filled('date') ? $request->date : date('Y-m-d');
        $pdf = PDF::loadview('pdf/medical_resume',['medicalRecord'=>$medicalRecord, 'date' => $date, 'dot' => '.............................................................................................................', 'shortDot' => '..........']);
        return $pdf->stream('resume-medis.pdf');
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
        if(isset($request->kb_history)) {
            $medical_record_detail->kb_history()->whereMedicalRecordId($medical_record->id)->delete();
            $kb_history = collect($request->kb_history);
            $kb_history = $kb_history->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_kb_history = 1;
                $medical_record_detail->save();
            });
        }

        $medical_record_detail = new MedicalRecordDetail();
        if(isset($request->komplikasi_kb_history)) {
            $medical_record_detail->komplikasi_kb_history()->whereMedicalRecordId($medical_record->id)->delete();
            $komplikasi_kb_history = collect($request->komplikasi_kb_history);
            $komplikasi_kb_history = $komplikasi_kb_history->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_komplikasi_kb_history = 1;
                $medical_record_detail->save();
            });
        }

        $medical_record_detail = new MedicalRecordDetail();
        if(isset($request->diagnose_history)) {
            $medical_record_detail->diagnose_history()->whereMedicalRecordId($medical_record->id)->delete();
            $diagnose_history = collect($request->diagnose_history);
            $diagnose_history = $diagnose_history->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_diagnose_history = 1;
                $medical_record_detail->save();
            });
        }

        $medical_record_detail = new MedicalRecordDetail();
        if(isset($request->kid_history)) {
            $medical_record_detail->kid_history()->whereMedicalRecordId($medical_record->id)->delete();
            $kid_history = collect($request->kid_history);
            $kid_history = $kid_history->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_kid_history = 1;
                $medical_record_detail->save();
            });
        }


        $medical_record_detail = new MedicalRecordDetail();
        if(isset($request->ginekologi_history)) {
            $medical_record_detail->ginekologi_history()->whereMedicalRecordId($medical_record->id)->delete();
            $ginekologi_history = collect($request->ginekologi_history);
            $ginekologi_history = $ginekologi_history->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_ginekologi_history = 1;
                $medical_record_detail->save();
            });
        }

        $medical_record_detail = new MedicalRecordDetail();
        if(isset($request->treatment)) {
            $medical_record_detail->treatment()->whereMedicalRecordId($medical_record->id)->delete();
            $treatment = collect($request->treatment);
            $treatment = $treatment->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_treatment = 1;
                $medical_record_detail->save();
            });
        }

        $medical_record_detail = new MedicalRecordDetail();
        if(isset($request->diagnostic)) {
            $medical_record_detail->diagnostic()->whereMedicalRecordId($medical_record->id)->delete();
            $diagnostic = collect($request->diagnostic);
            $diagnostic = $diagnostic->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_diagnostic = 1;
                $medical_record_detail->save();
            });
        }

        $medical_record_detail = new MedicalRecordDetail();
        if(isset($request->drug)) {
            $medical_record_detail->drug()->whereMedicalRecordId($medical_record->id)->delete();
            $drug = collect($request->drug);
            $drug = $drug->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_drug = 1;
                $medical_record_detail->save();
            });
        }


        $medical_record_detail = new MedicalRecordDetail();
        if(isset($request->imunisasi_history)) {
            $medical_record_detail->imunisasi_history()->whereMedicalRecordId($medical_record->id)->delete();
            $imunisasi_history = collect($request->imunisasi_history);
            $imunisasi_history = $imunisasi_history->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_imunisasi_history = 1;
                $medical_record_detail->save();
            });
        }


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

        if(isset($request->bhp)) {
            $medical_record_detail->bhp()->whereMedicalRecordId($medical_record->id)->delete();
            $bhp = collect($request->bhp);
            $bhp = $bhp->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_bhp = 1;
                $medical_record_detail->save();
            });
        }

        if(isset($request->sewa_ruangan)) {
            $medical_record_detail->sewa_ruangan()->whereMedicalRecordId($medical_record->id)->delete();
            $sewa_ruangan = collect($request->sewa_ruangan);
            $sewa_ruangan = $sewa_ruangan->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_sewa_ruangan = 1;
                $medical_record_detail->save();
            });
        }


        if(isset($request->sewa_alkes)) {
            $medical_record_detail->sewa_alkes()->whereMedicalRecordId($medical_record->id)->delete();
            $sewa_alkes = collect($request->sewa_alkes);
            $sewa_alkes = $sewa_alkes->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_sewa_alkes = 1;
                $medical_record_detail->save();
            });
        }

        if(isset($request->obgyn_disease_history)) {
            $medical_record_detail->obgyn_disease_history()->whereMedicalRecordId($medical_record->id)->delete();
            $obgyn_disease_history = collect($request->obgyn_disease_history);
            $obgyn_disease_history = $obgyn_disease_history->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_obgyn_disease_history = 1;
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

        if(isset($request->obgyn_family_disease_history)) {
            $medical_record_detail->obgyn_family_disease_history()->whereMedicalRecordId($medical_record->id)->delete();
            $obgyn_family_disease_history = collect($request->obgyn_family_disease_history);
            $obgyn_family_disease_history = $obgyn_family_disease_history->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_obgyn_family_disease_history = 1;
                $medical_record_detail->save();
            });
        }

        if(isset($request->allergy_history)) {
            $medical_record_detail->allergy_history()->whereMedicalRecordId($medical_record->id)->delete();
            $allergy_history = collect($request->allergy_history);
            $allergy_history = $allergy_history->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_allergy_history = 1;
                $medical_record_detail->save();
            });
        }
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    public function submit_research(Request $request, $id, $flag = '') {
        $this->validate($request, [
            'file' => 'required'
        ], [
            'file.required' => 'File tidak boleh kosong'
        ]);
        DB::beginTransaction();
        $medicalRecordDetail = new MedicalRecordDetail();
        $medicalRecordDetail->medical_record_id = $id;
        switch ($flag) {
            case 'radiology' :
                $file = $request->file('file');
                $ext = $file->getClientOriginalExtension();
                $filename = date('ymdhis') . Str::random(6) . '.' . $ext;
                $file->move(public_path('archive'), $filename);
                $medicalRecordDetail->fill($request->all());
                $medicalRecordDetail->description = $filename;
                $medicalRecordDetail->is_radiology = 1;
                $medicalRecordDetail->save();
                break;

            case 'laboratory' :
                $file = $request->file('file');
                $ext = $file->getClientOriginalExtension();
                $filename = date('ymdhis') . Str::random(6) . '.' . $ext;
                $file->move(public_path('archive'), $filename);
                $medicalRecordDetail->fill($request->all());
                $medicalRecordDetail->description = $filename;
                $medicalRecordDetail->is_laboratory = 1;
                $medicalRecordDetail->save();
                break;

            case 'pathology' :
                $file = $request->file('file');
                $ext = $file->getClientOriginalExtension();
                $filename = date('ymdhis') . Str::random(6) . '.' . $ext;
                $file->move(public_path('archive'), $filename);
                $medicalRecordDetail->fill($request->all());
                $medicalRecordDetail->description = $filename;
                $medicalRecordDetail->is_pathology = 1;
                $medicalRecordDetail->save();
                break;
        }
        DB::commit();
    }

    public function update_research(Request $request, $medical_record_detail_id) {
        $this->validate($request, [
            'kanan' => 'required',
            'kiri' => 'required'
        ], [
            'kanan.required' => 'Kanan tidak boleh kosong',
            'kiri.required' => 'Kiri tidak boleh kosong'
        ]);
        DB::beginTransaction();
        $medicalRecordDetail = MedicalRecordDetail::find($medical_record_detail_id);
        $medicalRecordDetail->fill($request->all());
        $medicalRecordDetail->save();
        
        DB::commit();
    }

    public function submit_schedule(Request $request, $id) {
        $this->validate($request, [
            'date' => 'required'
        ], [
            'date.required' => 'Tanggal tidak boleh kosong'
        ]);
        DB::beginTransaction();
        $medicalRecordDetail = new MedicalRecordDetail();
        $medicalRecordDetail->medical_record_id = $id;
        $medicalRecordDetail->is_schedule = 1;
        $medicalRecordDetail->date = $request->date;
        $medicalRecordDetail->save();        
        DB::commit();
        return Response::json(['message' => 'Data jadwal berhasil dimasukkan'], 200);
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
        $medical_record = MedicalRecord::findOrFail($id);
        $medical_record->is_active = 0;
        $medical_record->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }

    public function destroy_detail($id)
    {
        DB::beginTransaction();
        $medical_record_detail = MedicalRecordDetail::findOrFail($id);
        $filepath = public_path('archive') . '/' . $medical_record_detail->description;
        if (File::exists($filepath)) {
            File::delete($filepath);
        }
        $medical_record_detail->delete();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }
    
    public function clone($destination_id, $origin_id)
    {
        DB::beginTransaction();
        $origin_medical_record = MedicalRecord::find($origin_id)->toArray();
        $origin_medical_record = collect($origin_medical_record)
        ->except('code', 'patient_id')
        ->toArray();        

        $destination_medical_record = MedicalRecord::find($destination_id);
        $destination_medical_record->fill($origin_medical_record);
        $destination_medical_record->save();
        $origin_medical_record_detail = MedicalRecordDetail::whereMedicalRecordId($origin_id)->get()->toArray();
        $origin_medical_record_detail = collect($origin_medical_record_detail)
        ->each(function($val) use($destination_id){
            $val['medical_record_id'] =$destination_id;
            $destination_medical_record_detail = new MedicalRecordDetail();
            $destination_medical_record_detail->fill($val);
            $destination_medical_record_detail->save();
        })
        ->toArray();
        DB::commit();

        return Response::json(['message' => 'Rekam medis berhasil disalin'], 200);
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
