<?php

namespace App\Http\Controllers\Registration;

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

    public function printContent($id) {
        $dt = DB::table('pivot_medical_records')
        ->whereId($id)
        ->first();


        if(!$dt) {
            return response()->json(['message' => 'Data tidak ditemukan']);
        }
        $params['content'] = $dt->content;

        $pdf = PDF::loadview('pdf/medical_resume_template',$params);
        return $pdf->stream('resume-medis.pdf');

    }


}
