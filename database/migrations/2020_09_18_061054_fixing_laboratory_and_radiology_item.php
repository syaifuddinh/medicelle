<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixingLaboratoryAndRadiologyItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $radiology_types = DB::table('radiology_types')
        ->whereNotNull('price_id')
        ->get();
        foreach ($radiology_types as $r) {
            DB::table('prices')
            ->whereId($r->price_id)
            ->update(['destination' => 'RADIOLOGI']);
        }

        $laboratory_types = DB::table('laboratory_types')
        ->whereNotNull('price_id')
        ->get();
        foreach ($laboratory_types as $r) {
            DB::table('prices')
            ->whereId($r->price_id)
            ->update(['destination' => 'LABORATORIUM']);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
