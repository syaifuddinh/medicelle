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
            $table->integer('is_schedule')->nullable(false)->default(0);
            $table->integer('is_radiology')->nullable(false)->default(0);
            $table->integer('is_laboratory')->nullable(false)->default(0);
            $table->integer('is_pathology')->nullable(false)->default(0);
            $table->index(['is_radiology', 'is_laboratory', 'is_pathology']);
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
            $table->dropColumn(['signa1', 'signa2', 'result_date', 'is_radiology',  'is_pathology', 'is_laboratory', 'is_schedule']);
        });
    }
}
