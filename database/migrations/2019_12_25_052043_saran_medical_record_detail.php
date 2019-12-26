<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SaranMedicalRecordDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_record_details', function (Blueprint $table) {
            //
            $table->text('saran')->nullable(true);
            $table->text('kesimpulan')->nullable(true);
            $table->text('kanan')->nullable(true);
            $table->text('kiri')->nullable(true);
        });
        Schema::table('medical_records', function (Blueprint $table) {
            //
            $table->unsignedInteger('refer_doctor_id')->nullable(true)->after('id')->index();
            $table->foreign('refer_doctor_id')
              ->references('id')->on('contacts')
              ->onDelete('restrict');
        });
        Schema::table('registration_details', function (Blueprint $table) {
            //
            $table->unsignedInteger('medical_record_refer_id')->nullable(true)->after('id')->index();
            $table->foreign('medical_record_refer_id')
              ->references('id')->on('medical_records')
              ->onDelete('restrict');
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
            $table->dropColumn(['saran', 'kesimpulan', 'kanan', 'kiri']);
        });
        Schema::table('medical_records', function (Blueprint $table) {
            $table->dropColumn(['refer_doctor_id']);
        });
        Schema::table('registration_details', function (Blueprint $table) {
            $table->dropColumn(['medical_record_refer_id']);
        });
    }
}
