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
            $table->integer('pain_score')->nullable(false)->default(0);
            $table->string('pain_description')->nullable(true);

            $table->integer('fallen')->nullable(false)->default(0);
            $table->text('fallen_description')->nullable(true);
            $table->integer('secondary_diagnose')->nullable(false)->default(0);
            $table->text('secondary_diagnose_description')->nullable(true);
            $table->integer('helper')->nullable(false)->default(0);
            $table->text('helper_description')->nullable(true);
            $table->integer('infus')->nullable(false)->default(0);
            $table->text('infus_description')->nullable(true);
            $table->integer('walking')->nullable(false)->default(0);
            $table->text('walking_description')->nullable(true);
            $table->integer('mental')->nullable(false)->default(0);
            $table->text('mental_description')->nullable(true);

            $table->integer('risk_level')->nullable(false)->default(0);
            $table->string('risk_level_status', 25)->nullable(true);
            $table->string('risk_level_description', 200)->nullable(true);

            $table->integer('menarche_age')->nullable(false)->default();
            $table->string('siklus_haid', 200)->nullable(true);
            $table->integer('jumlah_pemakaian_pembalut')->nullable(false)->default(0);
            $table->string('lama_pemakaian_pembalut', 200)->nullable(true);
            $table->integer('is_tidy')->nullable(false)->default(0);
            $table->date('hpht')->nullable(true);
            $table->text('haid_complaint')->nullable(true);

            $table->text('marriage_status')->nullable(true);
            $table->string('marriage_duration', 200)->nullable(true);

            $table->integer('is_pernah_kb')->nullable(false)->default(0);
            $table->string('kb_item', 200)->nullable(true);
            $table->string('kb_start_time', 200)->nullable(true);
            $table->text('kb_complaint')->nullable(true);

            $table->integer('gravida')->nullable(false)->default(0);
            $table->integer('partus')->nullable(false)->default(0);
            $table->integer('abortus')->nullable(false)->default(0);
            $table->string('imunisasi_tt', 200)->nullable(true);
            $table->integer('pada_usia_kehamilan')->nullable(false)->default(0);
            $table->string('pemakaian_obat_saat_kehamilan', 200)->nullable(true);
            $table->string('keluhan_saat_kehamilan', 200)->nullable(true);
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
            $table->dropColumn(['is_disturb', 'pain_score', 'pain_description', 'fallen', 'fallen_description', 'secondary_diagnose', 'secondary_diagnose_description', 'helper', 'helper_description', 'infus', 'infus_description', 'walking', 'walking_description', 'mental', 'mental_description', 'risk_level', 'risk_level_description', 'risk_level_status', 'menarche_age','siklus_haid','jumlah_pemakaian_pembalut','lama_pemakaian_pembalut','is_tidy','hpht','haid_complaint','marriage_status','marriage_duration','is_pernah_kb','kb_item','kb_start_time','kb_complaint','gravida','partus','abortus','imunisasi_tt','pada_usia_kehamilan','pemakaian_obat_saat_kehamilan','keluhan_saat_kehamilan']);
        });
    }
}
