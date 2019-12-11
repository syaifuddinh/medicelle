<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AnamnesaMedicalRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_records', function (Blueprint $table) {
            $table->text('current_disease')->nullable(true)->index();
            $table->text('psiko_sosial')->nullable(true)->index();
            $table->text('operasi')->nullable(true)->index();
            $table->text('obgyn_main_complaint')->nullable(true)->index();
            $table->text('obgyn_current_disease')->nullable(true)->index();
            $table->text('obgyn_operasi')->nullable(true)->index();

            $table->text('physique')->nullable(true)->index();
            $table->text('ekg')->nullable(true)->index();
            $table->text('usg')->nullable(true)->index();
            $table->text('head_description')->nullable(true)->index();
            $table->text('breast_description')->nullable(true)->index();
            $table->text('rectum_description')->nullable(true)->index();
        });
        Schema::table('medical_record_details', function (Blueprint $table) {
            $table->string('disease_name', 200)->nullable(true)->index();
            $table->string('name', 200)->nullable(true)->index();
            $table->integer('duration')->nullable(false)->default(0)->index();
            $table->unsignedInteger('is_ginekologi_history')->nullable(false)->default(0)->index();
            $table->unsignedInteger('is_other_ginekologi')->nullable(false)->default(0)->index();
            $table->unsignedInteger('is_obgyn_disease_history')->nullable(false)->default(0)->index();
            $table->unsignedInteger('is_obgyn_family_disease_history')->nullable(false)->default(0)->index();
            $table->unsignedInteger('is_kb_history')->nullable(false)->default(0)->index();
            $table->unsignedInteger('is_komplikasi_kb_history')->nullable(false)->default(0)->index();

            $table->unsignedInteger('is_other')->nullable(false)->default(1)->index();
            $table->text('description')->nullable(true)->index();
            $table->string('type', 50)->nullable(true)->index();
            $table->unsignedInteger('is_diagnose_history')->nullable(false)->default(0)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medical_records', function (Blueprint $table) {
            $table->dropColumn(['current_disease', 'psiko_sosial', 'operasi', 'obgyn_main_complaint', 'obgyn_current_disease', 'obgyn_operasi', 'ekg', 'usg', 'physique', 'head_description', 'breast_description', 'rectum_description']);
        });
        Schema::table('medical_record_details', function (Blueprint $table) {
            $table->dropColumn(['disease_name', 'is_ginekologi_history', 'is_other_ginekologi', 'is_obgyn_disease_history', 'is_obgyn_family_disease_history', 'is_kb_history', 'is_komplikasi_kb_history', 'name', 'duration', 'is_other', 'is_diagnose_history', 'description', 'type']);
        });
    }
}
