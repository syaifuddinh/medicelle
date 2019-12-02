<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomAssesment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assesments', function (Blueprint $table) {
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

            $table->text('general_condition')->nullable(true);
            $table->string('gigi_tumbuh_pertama', 100)->nullable(true);

            $table->float('long')->nullable(false)->default(0);
            $table->float('weight')->nullable(false)->default(0);
            $table->float('blood_pressure')->nullable(false)->default(0);
            $table->float('pulse')->nullable(false)->default(0);
            $table->float('temperature')->nullable(false)->default(0);
            $table->float('breath_frequency')->nullable(false)->default(0);
            $table->float('prebirth_weight')->nullable(false)->default(0);
            $table->float('postbirth_weight')->nullable(false)->default(0);
            $table->float('birth_long')->nullable(false)->default(0);
            $table->float('birth_weight')->nullable(false)->default(0);
            $table->float('head_size')->nullable(false)->default(0);
            $table->float('arm_size')->nullable(false)->default(0);
            $table->float('berguling_usia')->nullable(false)->default(0);
            $table->float('duduk_usia')->nullable(false)->default(0);
            $table->float('merangkak_usia')->nullable(false)->default(0);
            $table->float('berdiri_usia')->nullable(false)->default(0);
            $table->float('berjalan_usia')->nullable(false)->default(0);
            $table->float('bicara_usia')->nullable(false)->default(0);

            $table->index(['gigi_tumbuh_pertama','long','weight','blood_pressure','pulse','temperature','breath_frequency','prebirth_weight','postbirth_weight','birth_long','birth_weight','head_size','arm_size','berguling_usia','duduk_usia','merangkak_usia','berdiri_usia','berjalan_usia','bicara_usia']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assesments', function (Blueprint $table) {
            $table->dropColumn('is_disturb','pain_score','pain_description','fallen','fallen_description','secondary_diagnose','secondary_diagnose_description','helper','helper_description','infus','infus_description','walking','walking_description','mental','mental_description','risk_level','risk_level_status','risk_level_description','menarche_age','siklus_haid','jumlah_pemakaian_pembalut','lama_pemakaian_pembalut','is_tidy','hpht','haid_complaint','marriage_status','marriage_duration','is_pernah_kb','kb_item','kb_start_time','kb_complaint','gravida','partus','abortus','imunisasi_tt','pada_usia_kehamilan','pemakaian_obat_saat_kehamilan','keluhan_saat_kehamilan','general_condition','gigi_tumbuh_pertama','long','weight','blood_pressure','pulse','temperature','breath_frequency','prebirth_weight','postbirth_weight','birth_long','birth_weight','head_size','arm_size','berguling_usia','duduk_usia','merangkak_usia','berdiri_usia','berjalan_usia','bicara_usia')
        });
    }
}
