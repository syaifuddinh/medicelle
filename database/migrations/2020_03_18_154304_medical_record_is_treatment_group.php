<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MedicalRecordIsTreatmentGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_record_details', function (Blueprint $table) {
            $table->integer('is_treatment_group')
            ->nullable(false)
            ->default(0)
            ->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medical_record_details', function (Blueprint $table) {
            $table->dropColumn(['is_treatment_group']);
        });
    }
}
