<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MedicalRecordReferenced extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pivot_medical_records', function (Blueprint $table) {
            $table->unsignedInteger('is_referenced')->nullable(false)->default(0)->index();
            $table->unsignedInteger('is_ruang_tindakan')->nullable(false)->default(0)->index();
            $table->unsignedInteger('is_radiology')->nullable(false)->default(0)->index();
            $table->unsignedInteger('is_laboratory')->nullable(false)->default(0)->index();
            $table->unsignedInteger('medical_record_detail_id')->nullable(true)->index();
            $table->json('additional')->nullable(false)->default('{}');

            $table->foreign('medical_record_detail_id')->references('id')->on('medical_record_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pivot_medical_records', function (Blueprint $table) {
            $table->dropForeign(['medical_record_detail_id']);
            $table->dropColumn(['is_referenced', 'is_ruang_tindakan', 'is_radiology', 'is_laboratory', 'medical_record_detail_id', 'additional']);
        });
    }
}
