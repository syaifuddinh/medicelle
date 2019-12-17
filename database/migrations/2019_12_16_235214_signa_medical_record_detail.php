<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SignaMedicalRecordDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_record_details', function (Blueprint $table) {
            $table->unsignedInteger('signa1')->nullable(true)->index();
            $table->unsignedInteger('signa2')->nullable(true)->index();
            $table->date('result_date')->nullable(true)->index();
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
            $table->dropColumn(['signa1', 'signa2', 'result_date',]);
        });
    }
}
