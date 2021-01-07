<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotMedicalRecordFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_medical_record_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('pivot_medical_record_id');
            $table->string('filename', 200);
            $table->string('name', 200);
            $table->timestamps();

            $table->foreign('pivot_medical_record_id')->references('id')->on('pivot_medical_records')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pivot_medical_record_files');
    }
}
