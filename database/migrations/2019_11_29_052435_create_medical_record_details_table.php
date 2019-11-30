<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_record_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('medical_record_id')->nullable(false)->index();
            $table->unsignedInteger('disease_id')->nullable(true)->index();
            $table->string('cure', 200)->nullable(true)->index();
            $table->date('last_checkup_date')->nullable(true)->index();

            $table->string('pain_location', 200)->nullable(true)->index();
            $table->integer('is_other_pain_type')->nullable(false)->default(0);
            $table->string('pain_type', 70)->nullable(true)->index();
            $table->string('pain_duration', 70)->nullable(true)->index();
            $table->string('emergence_time', 70)->nullable(true)->index();
            $table->string('side_effect', 170)->nullable(true)->index();

            $table->integer('is_unknown')->nullable(false)->default(0)->index();
            $table->integer('is_allergy_history')->nullable(false)->default(0)->index();
            $table->integer('is_disease_history')->nullable(false)->default(0)->index();
            $table->integer('is_family_disease_history')->nullable(false)->default(0)->index();
            $table->integer('is_pain_history')->nullable(false)->default(0)->index();
            $table->integer('is_pain_cure_history')->nullable(false)->default(0)->index();
            $table->timestamps();

            $table->foreign('disease_id')
              ->references('id')->on('items')
              ->onDelete('restrict');
            $table->foreign('medical_record_id')
              ->references('id')->on('medical_records')
              ->onDelete('cascade');
        });
        Schema::table('medical_records', function (Blueprint $table) {
            $table->integer('is_disturb')->nullable(false)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_record_details');
        Schema::table('medical_records', function (Blueprint $table) {
            $table->dropColumn('is_disturb');
        });
    }
}
