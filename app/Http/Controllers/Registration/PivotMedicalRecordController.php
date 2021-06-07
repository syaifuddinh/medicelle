<?php

namespace App\Http\Controllers\Registration;

use App\MedicalRecord;
use App\MedicalRecordDetail;
use App\PivotMedicalRecord;
use App\PivotMedicalRecordFile;
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

class PivotMedicalRecordController extends Controller
{
    public function showFiles($pivot_medical_record_id) {
        $t = PivotMedicalRecord::findOrFail($pivot_medical_record_id);

        return response()->json($t->files);
    }
	
	public function fetchMR($id) {
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

            'kb_history:id,medical_record_id,name,duration', 
            'komplikasi_kb_history:id,medical_record_id,name', 

            'ginekologi_history:id,medical_record_id,name', 

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

            'pain_history:id,medical_record_id,pain_location,is_other_pain_type,pain_type,pain_duration', 
            'pain_cure_history:medical_record_id,cure,emergence_time',
            'kid_history:medical_record_id,is_pregnant_week_age,kid_order,partus_year,partus_location,pregnant_month_age,pregnant_week_age,birth_type,birth_helper,birth_obstacle,weight,long,komplikasi_nifas,baby_gender',
            'imunisasi_history:medical_record_id,is_other_imunisasi,imunisasi_year_age,imunisasi_month_age,is_imunisasi_month_age,imunisasi,reaksi_imunisasi'
        )->findOrFail($id);

        return $resp;
    }

    public function destroyFiles($pivot_medical_record_id, $id) {
        $t = PivotMedicalRecord::findOrFail($pivot_medical_record_id);
        DB::beginTransaction();
        try {
            $dt = $t->files()->findOrFail($id);
            $path = public_path('files/' . $dt->filename);
            if(File::exists($path)) {
                File::delete($path);
            }
            $dt->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['message' => $e->getMessage()], 421);
        }
        return response()->json(['message' => 'Data berhasil dihapus']);
    }

    public function storeFiles(Request $request, $pivot_medical_record_id) {
        $t = PivotMedicalRecord::findOrFail($pivot_medical_record_id);
        DB::beginTransaction();
        try {
            if($request->hasFile('file')) {
                $filename = date('YmdHis') . Str::random(5) . '.png';
                $name = $request->file->getClientOriginalName();
                Image::make( file_get_contents( $request->file))->save(public_path('files/' . $filename));
                $params = [
                    'filename' => $filename,
                    'name' => $name
                ];
                $t->files()->create($params);
            } else {
                throw new Exception('File tidak boleh kosong');
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return Response::json(['message' => $e->getMessage()], 421);
        }

        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    public function storeContent(Request $request, $id) {
        $dt = DB::table('pivot_medical_records')
        ->whereId($id)
        ->first();

        if(!$dt) {
            return response()->json(['message' => 'Data tidak ditemukan']);
        }

        DB::table('pivot_medical_records')
        ->whereId($id)
        ->update([
            'content' => $request->content
        ]);

        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    public function showContent(Request $request, $id) {
        $dt = DB::table('pivot_medical_records')
        ->whereId($id)
        ->first();
		

        if(!$dt) {
            return response()->json(['message' => 'Data tidak ditemukan']);
        }

        return response()->json(['message' => 'Data berhasil disimpan', 'data' => $dt->content]);
    }

    public function printContent($id, $flag = 'preview') {
        $dt = DB::table('pivot_medical_records')
        ->whereId($id)
        ->first();
		
		$medicalRecord = $this->fetchMR($dt->medical_record_id);


        if(!$dt) {
            return response()->json(['message' => 'Data tidak ditemukan']);
        }
        $params['content'] = $dt->content;
		$params['medicalRecord'] = $medicalRecord;

        $pdf = PDF::loadview('pdf/medical_resume_template',$params);
        if($flag == 'preview') {
            return $pdf->stream('resume-medis.pdf');
        } else {
            return $pdf->download('resume-medis.pdf');            
        }

    }


}
