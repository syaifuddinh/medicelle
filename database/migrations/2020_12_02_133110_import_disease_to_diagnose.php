<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImportDiseaseToDiagnose extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $medicalRecordDetail = DB::table('medical_record_details')
        ->whereNotNull('disease_id')
        ->get();

        foreach ($medicalRecordDetail as $item) {
            $disease = DB::table('items')
            ->whereId($item->disease_id)
            ->first();

            $additional = json_decode($item->additional);
            $additional->diagnose_name = $disease->name;
            DB::table('medical_record_details')
            ->whereId($item->id)
            ->update([
                'additional' => json_encode($additional)
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
