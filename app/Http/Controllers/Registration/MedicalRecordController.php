<?php

namespace App\Http\Controllers\Registration;

use App\MedicalRecord;
use App\MedicalRecordDetail;
use App\LaboratoryType;
use App\PivotMedicalRecord;
use App\SideEffect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Mod;
use Response;
use DB;
use Str;
use File;
use PDF;
use PhpOffice\PhpWord\PhpWord;
use Image;
use Exception;

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

    public function pivot($pivot_medical_record_id)
    {
        $pivot = PivotMedicalRecord::with(
            'medical_record_detail:id,item_id',
            'medical_record_detail.item:id',
            'parent:id,additional',
            'medical_record_detail.item.price:id,item_id,laboratory_group,radiology_group'
        )->findOrFail($pivot_medical_record_id);
        return Response::json($pivot, 200);
    }

    public function showChildrenGrowth($id)
    {
        $data = [];
        $medicalRecord = DB::table('medical_records')
        ->whereId($id)
        ->first();
        $medicalRecord = MedicalRecord::wherePatientId($medicalRecord->patient_id)
        ->where('prebirth_weight', '>', 0)
        ->orderBy('medical_records.created_at', 'DESC')
        ->first();
        $command = 'SELECT "month", COALESCE(postbirth_weight, 0) AS postbirth_weight, COALESCE(prebirth_weight, 0) AS prebirth_weight, additional FROM (SELECT generate_series(1, 36) AS "month") AS "months" LEFT JOIN (SELECT id, "age", patient_id, postbirth_weight, prebirth_weight, additional FROM (SELECT medical_records.id, patient_id, medical_records.additional, prebirth_weight, postbirth_weight, (DATE_PART(\'year\', NOW()::date) - DATE_PART(\'year\', contacts.birth_date::date)) * 12 +
              (DATE_PART(\'month\', NOW()::date) - DATE_PART(\'month\', contacts.birth_date::DATE)) AS "age", ROW_NUMBER() OVER(partition BY TO_CHAR("date"::DATE, \'yyyy-mm\') ORDER BY "date" DESC) AS seqnum FROM medical_records JOIN contacts ON contacts.id = medical_records.patient_id WHERE medical_records.patient_id = ' . $medicalRecord->patient_id . ' ) AS medical_records WHERE seqnum = 1) AS patients ON patients.age = months.month';
        $childrenGrowth = collect(DB::select($command));
        $data['month'] = $childrenGrowth->map(function($c){
            return $c->month;
        });
        $pb_lahir = $medicalRecord->additional->pb_lahir ?? 0;
        $bb_lahir = $medicalRecord->prebirth_weight ?? 0;
        $prevBB = $bb_lahir ;
        $data['bb_sekarang'] = $childrenGrowth->map(function($c, $i) use ($bb_lahir, $prevBB){
            $postbirth_weight = $c->postbirth_weight ?? 0;
            if($i == 0) {
                $postbirth_weight = $bb_lahir;
            } else {
                if($postbirth_weight == 0) {
                    $postbirth_weight = $prevBB;
                }
            }
            $prevBB = $postbirth_weight;
            return $postbirth_weight;
        });
        $prevPB = $pb_lahir;
        $data['pb_sekarang'] = $childrenGrowth->map(function($c, $i) use ($pb_lahir, $prevPB){
            $additional = json_decode($c->additional ?? '{}');
            $pb_sekarang = $additional->pb_sekarang ?? 0;
            if($i == 0) {
                $pb_sekarang = $pb_lahir;
            } else {
                if($pb_sekarang == 0) {
                    $pb_sekarang = $prevPB;
                }
            }
            $prevPB = $pb_sekarang;
            return $pb_sekarang;
        });

        $setting = new \App\Http\Controllers\User\SettingController();
        $settingArea = collect($setting->fetch('children_growth'));
        $data['berat']['batas_atas'] = $settingArea->map(function($val){
            return $val->berat->batas_atas;
        });
        $data['berat']['batas_normal'] = $settingArea->map(function($val){
            return $val->berat->batas_normal;
        });
        $data['berat']['batas_bawah'] = $settingArea->map(function($val){
            return $val->berat->batas_bawah;
        });
        $data['panjang']['batas_atas'] = $settingArea->map(function($val){
            return $val->panjang->batas_atas;
        });
        $data['panjang']['batas_normal'] = $settingArea->map(function($val){
            return $val->panjang->batas_normal;
        });
        $data['panjang']['batas_bawah'] = $settingArea->map(function($val){
            return $val->panjang->batas_bawah;
        });
        return Response::json($data, 200);
    }

    public function showInternalRadiology($id)
    {
        $medicalRecord = DB::table('medical_records')
        ->whereId($id)
        ->first();
        $medicalRecord = MedicalRecord::wherePatientId($medicalRecord->patient_id)
        ->join('pivot_medical_records', 'pivot_medical_records.medical_record_id', 'medical_records.id')
        ->where('pivot_medical_records.is_radiology', 1)
        ->leftJoin('medical_record_details', 'pivot_medical_records.medical_record_detail_id', 'medical_record_details.id')
        ->leftJoin('prices', 'medical_record_details.item_id', 'prices.item_id')
        ->leftJoin('radiology_types', 'radiology_types.id', 'prices.radiology_group')
        ->orderBy('medical_records.created_at', 'DESC')
        ->select(
            'medical_record_details.id',
            'medical_record_details.reduksi',
            DB::raw('pivot_medical_records.additional ->> \'radiology_description\' AS description'), 
            DB::raw('pivot_medical_records.additional ->> \'hasil_pemeriksaan\' AS hasil_pemeriksaan'), 
            DB::raw('pivot_medical_records.additional ->> \'klinis\' AS klinis'), 
            DB::raw('pivot_medical_records.additional ->> \'kanan\' AS kanan'), 
            DB::raw('pivot_medical_records.additional ->> \'kiri\' AS kiri'), 
            DB::raw('pivot_medical_records.additional ->> \'saran\' AS saran'), 
            DB::raw('pivot_medical_records.additional ->> \'kesimpulan\' AS kesimpulan'), 
            'radiology_types.name', 
            'medical_records.date'
        )
        ->get();

        return Response::json($medicalRecord, 200);
    }

    public function showInternalLaboratory($id)
    {
        $medicalRecord = DB::table('medical_records')
        ->whereId($id)
        ->first();
        $medicalRecord = MedicalRecord::wherePatientId($medicalRecord->patient_id)
        ->join('pivot_medical_records', 'pivot_medical_records.medical_record_id', 'medical_records.id')
        ->where('pivot_medical_records.is_laboratory', 1)
        ->where('pivot_medical_records.is_laboratory_treatment', 0)
        ->leftJoin('medical_record_details', 'pivot_medical_records.medical_record_detail_id', 'medical_record_details.id')
        ->leftJoin('items', 'medical_record_details.item_id', 'items.id')
        ->orderBy('medical_records.created_at', 'DESC')
        ->select(DB::raw('pivot_medical_records.additional'), 'items.name', 'medical_records.date')
        ->get();

        $medicalRecord = $medicalRecord->map(function($m){
            $details = $m->additional->treatment[0]->detail;
            $params = [];
            foreach ($details as $d => $val) {
                if(($val->is_active ?? 0) == 1) {
                    $params[] = $val;
                }
            }
            $resp = $m->only('name', 'date');
            $resp['details'] = $params;
            return $resp;
        });

        return Response::json($medicalRecord, 200);
    }

    public function update_laboratory_form(Request $request, $pivot_medical_record_id)
    {
        $pivot = PivotMedicalRecord::findOrFail($pivot_medical_record_id);
        $additional = $pivot->additional;
        $additional->treatment[$request->row]->detail[$request->column]->{$request->key} = $request->value;
        $pivot->additional = json_encode($additional);
        $pivot->save();
        $is_tested = 0;
        foreach ($pivot->additional->treatment as $treatment) {
            foreach ($treatment->detail as $detail) {
                if(($detail->is_active ?? null)) {                
                    if($detail->is_active == 1) {
                        if(($detail->hasil ?? null) || ($detail->satuan ?? null) || ($detail->nilai_normal ?? null) || ($detail->keterangan ?? null)) {
                            $is_tested = 1;
                            break 2;
                        }
                    }
                }
            }
        }
        DB::table('pivot_medical_records')
        ->whereParentId($pivot_medical_record_id)
        ->update([
            'is_tested' => $is_tested
        ]);
        return Response::json(['message' => 'Data berhasil di-update'], 200);
    }

    public function update_ruang_tindakan_description(Request $request, $id) {
        $additional = [
            'ruang_tindakan_description' => $request->ruang_tindakan_description ?? ''
        ];

        DB::table('pivot_medical_records')
        ->whereId($id)
        ->update([
            'additional' => json_encode($additional)
        ]);

        return Response::json(['message' => 'Dokter rujukan telah dipilih'], 200);
    }

    public function update_additional_pivot(Request $request, $id) {
        $pivot_medical_record = PivotMedicalRecord::findOrFail($id);
        $additional = $pivot_medical_record->additional;
        $inputs = $request->all();
        if($request->radiology_description) {
            $pivot_medical_record->is_tested = 1;
        } else {
            $pivot_medical_record->is_tested = 0;
        }
        foreach ($inputs as $key => $input) {
            $additional->{$key} = $input;
        }

        $pivot_medical_record->additional = json_encode($additional);
        $pivot_medical_record->save();

        return Response::json(['message' => 'Data berhasil di-update'], 200);
    }
    public function update_laboratory(Request $request, $id) {
        $pivot_medical_record = PivotMedicalRecord::findOrFail($id);
        $additional = $pivot_medical_record->additional;
       $additional->treatment[$request->row]->detail[$request->column]->is_active = $request->is_active;

        $pivot_medical_record->additional = json_encode($additional);
        $pivot_medical_record->save();


        return Response::json(['message' => 'Data berhasil di-update'], 200);
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
        $medicalRecordDetail = MedicalRecordDetail::with('medical_record:id,registration_id,registration_detail_id', 'medical_record.registration:id,code,patient_type', 'medical_record.registration_detail:id,doctor_id,polyclinic_id,destination', 'medical_record.registration_detail.doctor:id,name,specialization_id,phone', 'medical_record.registration_detail.doctor.specialization:id,name')
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
            'registration_detail:id,status,doctor_id', 
            'registration_detail.doctor:id,name,polyclinic_id',
            'registration_detail.doctor.polyclinic:id,name',
            'patient:id,name,age,address,gender,phone,marriage_status', 
            'bhp:id,medical_record_id,item_id,qty,date,lokasi_id',
            'bhp.item:id,name,piece_id',
            'bhp.item.piece:id,name',
            'bhp.lokasi:id,name',
            'sewa_instrumen:id,medical_record_id,item_id,qty,date,lokasi_id',
            'sewa_instrumen.item:id,name',
            'sewa_alkes:id,medical_record_id,item_id,qty,date,lokasi_id',
            'sewa_alkes.item:id,name,piece_id',
            'sewa_alkes.item.piece:id,name',
            'sewa_alkes.lokasi:id,name',
            'sewa_ruangan:id,medical_record_id,item_id,qty,date,lokasi_id',
            'sewa_ruangan.item:id,name,piece_id',
            'sewa_ruangan.item.piece:id,name',
            'sewa_ruangan.lokasi:id,name',
            'radiology:id,medical_record_id,date,result_date,name,description,is_radiology,saran,kesimpulan,kanan,kiri',
            'laboratory:id,medical_record_id,date,result_date,name,description,is_laboratory,additional',
            'pathology:id,medical_record_id,date,result_date,name,description,is_pathology',
            'diagnose_history:id,medical_record_id,disease_id,item_id,type,description,additional',
            'diagnose_history.disease:id,name',
            
            'children_diagnose_history:id,medical_record_id,disease_id,item_id,type,description',
            'children_diagnose_history.disease:id,name',

            'disease_history:id,medical_record_id,disease_name,cure,description',
            'obgyn_disease_history:id,medical_record_id,disease_name,cure,description',

            'family_disease_history:id,medical_record_id,disease_name,cure,description', 
            'obgyn_family_disease_history:id,medical_record_id,disease_name,cure,description', 

            'kb_history:medical_record_id,name,duration', 
            'komplikasi_kb_history:medical_record_id,name', 

            'ginekologi_history:medical_record_id,name', 

            'treatment:id,medical_record_id,item_id,date,qty,reduksi', 
            'treatment_group:id,medical_record_id,item_id,date,qty,reduksi', 
            'diagnostic:id,medical_record_id,item_id,date,qty,reduksi', 
            'diagnostic.laboratory_pivot:id,medical_record_detail_id,additional', 
            'drug:id,medical_record_id,item_id,date,qty,signa1,signa2,stock_id', 
            'drug.item:id,name,piece_id',
            'drug.s1:id,name',
            'drug.s2:id,name',
            'drug.item.piece:id,name',

            'pain_history:medical_record_id,pain_location,is_other_pain_type,pain_type,pain_duration', 
            
            'allergy_history:id,medical_record_id,cure,side_effect', 
            'pain_history:id,medical_record_id,pain_location,is_other_pain_type,pain_type,pain_duration', 
            'pain_cure_history:medical_record_id,cure,emergence_time',
            'kid_history:medical_record_id,is_pregnant_week_age,kid_order,partus_year,partus_location,pregnant_month_age,pregnant_week_age,birth_type,birth_helper,birth_obstacle,weight,long,komplikasi_nifas,baby_gender',
            'imunisasi_history:medical_record_id,is_other_imunisasi,imunisasi_year_age,imunisasi_month_age,is_imunisasi_month_age,imunisasi,reaksi_imunisasi'
        )->findOrFail($id);

        return $resp;
    }

    public function showReviewHistory($id, $flag) {
        $medicalRecord = MedicalRecord::findOrFail($id);
        $resp = MedicalRecordDetail::join('medical_records', 'medical_records.id', 'medical_record_details.medical_record_id')
        ->where('medical_records.patient_id', $medicalRecord->patient_id)
        ->where('medical_record_details.medical_record_id', '!=', $id);
        if($flag == 'radiology') {
            $resp->whereIsRadiology(1);
        } else if($flag == 'laboratory') {
            $resp->whereIsLaboratory(1);
        } else if($flag == 'pathology') {
            $resp->whereIsPathology(1);
        } else {
            return Response::json(['message' => 'Halaman tidak ditemukan'], 404);
        }

        $resp = $resp->select('medical_record_details.id', 'medical_record_details.date', 'medical_record_details.result_date', 'medical_record_details.description', 'is_radiology', 'is_laboratory', 'is_pathology', 'medical_record_details.additional')
        ->get();

        return Response::json($resp);
    }

    public function show($id)
    {

        $x = $this->fetch($id);
        return Response::json($x, 200);
    }

    public function pdf(Request $request, $id, $flag = 'preview')
    {
        $pivot = PivotMedicalRecord::findOrFail($id);
        $medicalRecord = $this->fetch($pivot->medical_record_id);
        $date = $request->filled('date') ? $request->date : date('Y-m-d');
        $params = [
            'medicalRecord'=>$medicalRecord, 
            'resume_description' => $pivot->additional->resume_description ?? '',
            'date' => $date, 
            'dot' => '.............................................................................................................', 
            'shortDot' => '..........'
        ];
        $pdf = PDF::loadview('pdf/medical_resume',$params);
        if($flag == 'preview') {
            return $pdf->stream('resume-medis.pdf');
        } else {
            return $pdf->download('resume-medis.pdf');            
        }
    }

    public function docx(Request $request, $id)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $pivot = PivotMedicalRecord::findOrFail($id);
        $medicalRecord = $this->fetch($pivot->medical_record_id);
        $resume_description = $pivot->additional->resume_description ?? '';
        $date = $request->filled('date') ? $request->date : date('Y-m-d');
        $dot = '....................................................';
        $shortDot = '...............';
        // Adding an empty Section to the document...
        $section = $phpWord->addSection('RESUME MEDIS');
        $header = $section->addHeader();
        $company = Mod::company();
        $phpWord->addFontStyle('textHeader', array('bold'=>true, 'size' => 14));
        $phpWord->addFontStyle('textSubheader', array('bold'=>true, 'size' => 13));
        if(file_exists(public_path().'/files/' . $company->logo2_name)) {
            $header->addImage($company->logo2, [
                'width' => 60,
                'height' => 60,
                'wrappingStyle' => 'inline',
                'positioning' => 'absolute'
            ]);
        }
        $textBox = $header->addTextBox([
            'width' => 350,
            'height' => 70,
            'borderColor' => 'white',
            'positioning' => 'relative'
        ]);
        $textBox->addText("\t    " . $company->name , 'textHeader');
        $textBox->addText("\t      " . $company->address);
        $textBox->addText("\t      " . 'Telp : ' . $company->phone_number . ' Fax : ' . $company->fax);
        // Adding Text element to the Section having font styled by default...
        $phpWord->addFontStyle('textBold', array('bold'=>true));
        $phpWord->addParagraphStyle('subtitle', array('align'=>'center', 'spaceAfter' => 300));
        $phpWord->addParagraphStyle('textCenter', array('align'=>'center'));
        $phpWord->addParagraphStyle('spaceGeneral', array('spaceAfter'=>40));
        $phpWord->addParagraphStyle('spaceMedium', array('spaceAfter'=>350));
        $section->addText( "", '', 'spaceMedium');
        $section->addText( "RESUME MEDIS\n\n\n\n", 'textBold', 'subtitle');

        $section->addText(
            "No Rekam Medis\t : " . $medicalRecord->code, '', 'spaceGeneral'
        );
        $section->addText(
            "Nama\t\t\t : " . $medicalRecord->registration->patient->patient_type . ' ' . $medicalRecord->registration->patient->name, '', 'spaceGeneral'
        );
        $section->addText(
            "Tanggal lahir\t\t : " . Mod::fullDate($medicalRecord->registration->patient->birth_date), '', 'spaceGeneral'
        );

        $section->addText(
            "Alamat\t\t\t : " . $medicalRecord->registration->patient->address, '', 'spaceGeneral'
        );
        $section->addText(
            '', '', 'spaceGeneral'
        );

        // Adding Text element with font customized using named font style...
        $section->addText(
            "\tDatang dengan keluhan utama " . ($medicalRecord->main_complaint ?? $dot) . ", riwayat penyakit sekarang " . ($medicalRecord->current_disease ?? $dot) . '. Penyakit dahulu'
            );
        foreach($medicalRecord->disease_history as $unit) {
            if($unit->disease_name) {
                $section->addListItem($unit->disease_name, 0);
            }
        }


        $section->addText('' , '', 'spaceGeneral');
        $section->addText('Pemeriksaan fisik didapatkan :' , '', 'spaceGeneral');
        $section->addText('');
        $section->addText('Tensi : ' . ($medicalRecord->blood_pressure ?? $shortDot) . ' mmHg, Nadi : ' . $medicalRecord->pulse ?? $shortDot . ' x/menit, Suhu badan : ' . ($medicalRecord->temperature ?? $shortDot) . ' oC, Nafas : ' . ($medicalRecord->breath_frequency ?? $shortDot) . ' x/menit');
        $section->addText('' , '', 'spaceGeneral');
        $section->addText('Diagnosis : ' , '', 'spaceGeneral');
        foreach($medicalRecord->diagnose_history as $unit) {
            $section->addListItem($unit->disease->name, 0);
        }
        $section->addText('' , '', 'spaceGeneral');
        $section->addText('Terapi : ' , '', 'spaceGeneral');
        foreach($medicalRecord->drug as $unit) {
            $section->addListItem(($unit->item->name ?? ($unit->stock->item->name ??'')) . ' sebanyak ' . $unit->qty . ' ' . ($unit->item->piece->name ?? ''), 0);
        }

        $section->addText('Jadwal kontrol selanjutnya pada hari ' . ($medicalRecord->next_schedule->date ? Mod::day($medicalRecord->next_schedule->date) : $shortDot) . ', tanggal ' . $medicalRecord->next_schedule->date ? Mod::fullDate($medicalRecord->next_schedule->date) : $shortDot , '', 'spaceGeneral');
        $section->addText('' , '', 'spaceGeneral');
        $section->addText('Jadwal kontrol selanjutnya pada hari ' . ($medicalRecord->next_schedule->date ? Mod::day($medicalRecord->next_schedule->date) : $shortDot)  . ', tanggal ' . ($medicalRecord->next_schedule->date ? Mod::fullDate($medicalRecord->next_schedule->date) : $shortDot), '', 'spaceGeneral');

        $section->addText('Keterangan' , '', 'spaceGeneral');
        $section->addText($resume_description , '', 'spaceGeneral');
        $section->addText('' , '', 'spaceGeneral');
        $section->addText('Visual' , '', 'spaceGeneral');
        $section->addText('' , '', 'spaceMedium');
        $section->addText('Surabaya, '  . Mod::fullDate($date));
        $section->addText('');
        $section->addText('');
        $section->addText('');
        $section->addText($medicalRecord->registration_detail->doctor->name);
        $section->addText('SPESIALIS ' .  strtoupper($medicalRecord->registration_detail->doctor->specialization->name ?? ''), 'textBold');
        $footer = $section->addFooter();
        $footer->addText( ($company->phone_number ?? '') . "\t" . ($company->whatsapp_number ?? '') . "\t" . ($company->website ?? '') . "\t" . ($company->email ?? '') , '', 'textCenter');
        $filename = 'medical_resume.docx';  
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($filename);        
        $file= public_path(). "/" . $filename;

        return response()->download($file);
    }

    public function ruang_tindakan_pdf(Request $request, $id)
    {
   
        $pivotMedicalRecord = PivotMedicalRecord::findOrFail($id);
        $medicalRecord = MedicalRecord::find($pivotMedicalRecord->medical_record_id);
        $params = [
            'pivotMedicalRecord' => $pivotMedicalRecord,
            'medicalRecord' => $medicalRecord, 
            'dot' => '.............................................................................................................', 
            'shortDot' => '..........'
        ];
        $pdf = PDF::loadview('pdf/ruang_tindakan', $params);
        return $pdf->stream('ruang_tindakan.pdf');
    }

    public function laboratory_pdf(Request $request, $id, $type = 'single')
    {
        if($type == 'single') {
            $pivotMedicalRecord = PivotMedicalRecord::findOrFail($id);
            $medics = [$pivotMedicalRecord];
            $medicalRecord = MedicalRecord::find($pivotMedicalRecord->medical_record_id);
        } else if($type == 'multiple') {
            $medicalRecord = MedicalRecord::find($id);
            $medics = PivotMedicalRecord::whereMedicalRecordId($id)
            ->whereIsLaboratory(1)
            ->get();
        }
        $treatments = [];
        foreach ($medics as $medic) {
            foreach($medic->additional->treatment as $treatment) {
                $treatments[] = $treatment;
            }
        }

        $treatments = collect($treatments)->chunk(4);

        $laboratoryType = LaboratoryType::with('laboratory_type_detail:id,laboratory_type_id,name')->get(); 
        $params = [
                'treatments' => $treatments,
                'medicalRecord' => $medicalRecord, 
                'dot' => '.............................................................................................................', 
                'shortDot' => '..........'];
        $pdf = PDF::loadview('pdf/laboratory/laboratory', $params);

        return $pdf->stream('laboratory.pdf');
    }

    public function usg_mammae_pdf(Request $request, $id)
    {
        $pivotMedicalRecord = PivotMedicalRecord::findOrFail($id);
        $medicalRecord = MedicalRecord::find($pivotMedicalRecord->medical_record_id);
        $pdf = PDF::loadview('pdf/radiology/usg_mammae',['pivotMedicalRecord' => $pivotMedicalRecord,'medicalRecord' => $medicalRecord, 'dot' => '.............................................................................................................', 'shortDot' => '..........']);
        return $pdf->stream('usg_mammae.pdf');
    }

    public function usg_abdomen_upper_lower_wanita_pdf(Request $request, $id)
    {
        $pivotMedicalRecord = PivotMedicalRecord::findOrFail($id);
        $medicalRecord = MedicalRecord::find($pivotMedicalRecord->medical_record_id);
        $pdf = PDF::loadview('pdf/radiology/usg_abdomen_upper_lower_wanita',['pivotMedicalRecord' => $pivotMedicalRecord,'medicalRecord' => $medicalRecord, 'dot' => '.............................................................................................................', 'shortDot' => '..........']);
        return $pdf->stream('usg_abdomen_upper_lower_wanita.pdf');
    }

    public function usg_abdomen_upper_lower_pria_pdf(Request $request, $id)
    {
        $pivotMedicalRecord = PivotMedicalRecord::findOrFail($id);
        $medicalRecord = MedicalRecord::find($pivotMedicalRecord->medical_record_id);
        $pdf = PDF::loadview('pdf/radiology/usg_abdomen_upper_lower_pria',['pivotMedicalRecord' => $pivotMedicalRecord,'medicalRecord' => $medicalRecord, 'dot' => '.............................................................................................................', 'shortDot' => '..........']);
        return $pdf->stream('usg_abdomen_upper_lower_pria.pdf');
    }

    public function usg_thyroid_pdf(Request $request, $id)
    {
        $pivotMedicalRecord = PivotMedicalRecord::findOrFail($id);
        $medicalRecord = MedicalRecord::find($pivotMedicalRecord->medical_record_id);
        $pdf = PDF::loadview('pdf/radiology/usg_thyroid',['pivotMedicalRecord' => $pivotMedicalRecord,'medicalRecord' => $medicalRecord, 'dot' => '.............................................................................................................', 'shortDot' => '..........']);
        return $pdf->stream('usg_thyroid.pdf');
    }

    public function mammografi_pdf(Request $request, $id)
    {
        $pivotMedicalRecord = PivotMedicalRecord::findOrFail($id);
        $medicalRecord = MedicalRecord::find($pivotMedicalRecord->medical_record_id);
        $pdf = PDF::loadview('pdf/radiology/mammografi',['pivotMedicalRecord' => $pivotMedicalRecord,'medicalRecord' => $medicalRecord, 'dot' => '.............................................................................................................', 'shortDot' => '..........']);
        return $pdf->stream('mammografi.pdf');
    }

    public function radiology_pdf(Request $request, $id, $contact_id)
    {
        $contact_name = DB::table('contacts')
            ->whereId($contact_id)
            ->select('name')
            ->first()
            ->name ?? '';
        $pivotMedicalRecord = PivotMedicalRecord::findOrFail($id);
        $medicalRecord = MedicalRecord::find($pivotMedicalRecord->medical_record_id);
        $price = DB::table('prices')
        ->whereItemId($pivotMedicalRecord->medical_record_detail->item_id)
        ->first();
        $radiologyType = DB::table('radiology_types')
        ->whereId($price->radiology_group)
        ->first();
        $params = [
            'contact_name' => $contact_name,
            'pivotMedicalRecord' => $pivotMedicalRecord, 
            'medicalRecord' => $medicalRecord, 
            'radiologyType' => $radiologyType, 
            'dot' => '.............................................................................................................', 
            'shortDot' => '..........'
        ];
        $pdf = PDF::loadview('pdf/radiology/radiology', $params);
        return $pdf->stream('radiology.pdf');
    }

    public function chemoterapy_pdf(Request $request, $id, $contact_id)
    {
        $contact_name = DB::table('contacts')
        ->whereId($contact_id)
        ->select('name')
        ->first()
        ->name ?? '';
        $pivotMedicalRecord = PivotMedicalRecord::findOrFail($id);
        $medicalRecord = MedicalRecord::find($pivotMedicalRecord->medical_record_id);
        $price = DB::table('prices')
        ->whereItemId($pivotMedicalRecord->medical_record_detail->item_id)
        ->first();
        $keadaanUmum = DB::table('permissions')
        ->whereIsKeadaanUmum(1)
        ->select('name')
        ->get();

        $sideEffects = SideEffect::with('detail:side_effect_id,name')
        ->select('id', 'name')
        ->get();
        $params = [
            'contact_name' => $contact_name,
            'pivotMedicalRecord' => $pivotMedicalRecord, 
            'medicalRecord' => $medicalRecord, 
            'keadaanUmum' => $keadaanUmum, 
            'sideEffects' => $sideEffects, 
            'dot' => '.............................................................................................................', 
            'shortDot' => '..........'
        ];
        $pdf = PDF::loadview('pdf/chemoterapy/chemoterapy', $params);
        return $pdf->stream('radiology.pdf');
    }

    public function xray_pdf(Request $request, $id)
    {
        $pivotMedicalRecord = PivotMedicalRecord::findOrFail($id);
        $medicalRecord = MedicalRecord::find($pivotMedicalRecord->medical_record_id);
        $pdf = PDF::loadview('pdf/radiology/xray',['pivotMedicalRecord' => $pivotMedicalRecord,'medicalRecord' => $medicalRecord, 'dot' => '.............................................................................................................', 'shortDot' => '..........']);
        return $pdf->stream('xray.pdf');
    }

    public function fnab_pdf(Request $request, $id)
    {
        $medicalRecord = $this->fetch($id);
        $pdf = PDF::loadview('pdf/fnab',['medicalRecord' => $medicalRecord, 'dot' => '.............................................................................................................', 'shortDot' => '..........']);
        return $pdf->stream('fnab.pdf');
    }

    public function laboratory_form_pdf(Request $request, $pivot_medical_record_id, $contact_id)
    {   
        $contact_name = DB::table('contacts')
            ->whereId($contact_id)
            ->select('name')
            ->first()
            ->name ?? '';
        $pivot = PivotMedicalRecord::findOrFail($pivot_medical_record_id);
        $medicalRecordDetail = MedicalRecordDetail::find($pivot->medical_record_detail_id);
        $medicalRecord = $this->fetch($medicalRecordDetail->medical_record_id);
        $params = [
            'contact_name' => $contact_name,
            'medicalRecord' => $medicalRecord, 
            'treatments' => $pivot->parent->additional->treatment, 
            'dot' => '.............................................................................................................', 
            'shortDot' => '..........'
        ];
        $pdf = PDF::loadview('pdf/laboratory/laboratory_form', $params);
        return $pdf->stream('fnab.pdf');
    }

    public function histopatologi_pdf(Request $request, $id)
    {
        $medicalRecord = $this->fetch($id);
        $pdf = PDF::loadview('pdf/histopatologi',['medicalRecord' => $medicalRecord, 'dot' => '.............................................................................................................', 'shortDot' => '..........']);
        return $pdf->stream('histopatologi.pdf');
    }

    public function papsmear_pdf(Request $request, $id)
    {
        $medicalRecord = $this->fetch($id);
        $pdf = PDF::loadview('pdf/papsmear',['medicalRecord' => $medicalRecord, 'dot' => '.............................................................................................................', 'shortDot' => '..........']);
        return $pdf->stream('papsmear.pdf');
    }
    public function sitologi_pdf(Request $request, $id)
    {
        $medicalRecord = $this->fetch($id);
        $pdf = PDF::loadview('pdf/sitologi',['medicalRecord' => $medicalRecord, 'dot' => '.............................................................................................................', 'shortDot' => '..........']);
        return $pdf->stream('sitologi.pdf');
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

        if(isset($request->sewa_instrumen)) {
            $medical_record_detail->sewa_instrumen()->whereMedicalRecordId($medical_record->id)->delete();
            $sewa_ruangan = collect($request->sewa_ruangan);
            $sewa_ruangan = $sewa_ruangan->each(function($val) use($medical_record){
                $medical_record_detail = new MedicalRecordDetail();
                $val['medical_record_id'] = $medical_record->id;
                $medical_record_detail->fill($val);
                $medical_record_detail->is_sewa_instrumen = 1;
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

    public function store_signature(Request $request, $id, $flag) {
        $medical_record = MedicalRecord::findOrFail($id);
        $filename = '';
        if($request->hasFile($flag . '_visual')) {
            if(null != ($medical_record->additional->{$flag . '_visual'} ?? null)) {
                $base_url = asset('files') . '/';
                $file = str_replace($base_url, '', $medical_record->additional->{$flag . '_visual'});
                File::delete(public_path('files/' . $file));
            }
            $filename = date('YmdHis') . Str::random(5) . '.png';
            Image::make( file_get_contents( $request->{$flag . '_visual'}))->save(public_path('files/' . $filename));
        }
        $additional = ["$flag" . '_visual' => $filename];
        $medical_record->additional = $additional;
        $medical_record->save();

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

    public function store_detail(Request $request, $id) {

        DB::beginTransaction();
        try {
            $medicalRecord = MedicalRecord::findOrFail($id);
            if($request->is_treatment == 1) {
                $input = $request->all();
                $input['is_treatment'] = 1;
                $medicalRecord->treatment()->create($input);
            } if($request->is_disease_history == 1) {
                $input = $request->all();
                $input['is_disease_history'] = 1;
                $medicalRecord->disease_history()->create($input);
            } if($request->is_family_disease_history == 1) {
                $input = $request->all();
                $input['is_family_disease_history'] = 1;
                $medicalRecord->family_disease_history()->create($input);
            } if($request->is_allergy_history == 1) {
                $input = $request->all();
                $input['is_allergy_history'] = 1;
                $medicalRecord->allergy_history()->create($input);
            } if($request->is_sewa_instrumen == 1) {
                $input = $request->all();
                $input['is_sewa_instrumen'] = 1;
                $medicalRecord->sewa_instrumen()->create($input);
            } if($request->is_sewa_ruangan == 1) {
                $input = $request->all();
                $input['is_sewa_ruangan'] = 1;
                $medicalRecord->sewa_instrumen()->create($input);
            } if($request->is_sewa_alkes == 1) {
                $input = $request->all();
                $input['is_sewa_alkes'] = 1;
                $medicalRecord->sewa_instrumen()->create($input);
            } if($request->is_bhp == 1) {
                $input = $request->all();
                $input['is_bhp'] = 1;
                $medicalRecord->sewa_instrumen()->create($input);
            } else if($request->is_diagnostic == 1) {
                $input = $request->all();
                $input['is_diagnostic'] = 1;
                $medicalRecord->diagnostic()->create($input);
            } else if($request->is_drug == 1) {
                $input = $request->all();
                $input['is_drug'] = 1;
                $medicalRecord->drug()->create($input);
            } else if($request->is_treatment_group == 1) {
                $input = $request->all();
                $input['is_treatment_group'] = 1;
                $medicalRecord->treatment_group()->create($input);
            } else if($request->is_diagnose_history == 1) {
                $input = $request->all();
                $input['is_diagnose_history'] = 1;
                $medicalRecord->diagnose_history()->create($input);
            } else if($request->is_children_diagnose_history == 1) {
                $input = $request->all();
                $input['is_children_diagnose_history'] = 1;
                $medicalRecord->children_diagnose_history()->create($input);
            } 
            DB::commit();
        } catch(Exception $e) {
            return Response::json(['message' => $e->getMessage()], 422);
        }

        return Response::json(['message' => 'Detail berhasil disimpan']);
    }

    public function update_detail(Request $request, $medical_record_id, $id) {

        DB::beginTransaction();
        try {
            MedicalRecord::findOrFail($medical_record_id);
            $medicalRecordDetail = MedicalRecordDetail::findOrFail($id);
            $medicalRecordDetail->fill($request->all());
            $medicalRecordDetail->save();
            DB::commit();
        } catch(Exception $e) {
            return Response::json(['message' => $e->getMessage()], 422);
        }

        return Response::json(['message' => 'Detail berhasil disimpan']);
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

    public function destroy_detail($id, $detail_id)
    {
        DB::beginTransaction();
        $medical_record_detail = MedicalRecordDetail::findOrFail($detail_id);
        $medical_record_detail->delete();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dihapus'], 200);
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