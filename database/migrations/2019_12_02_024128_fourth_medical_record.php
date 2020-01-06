<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FourthMedicalRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_records', function (Blueprint $table) {
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
        Schema::table('medical_records', function (Blueprint $table) {
            $table->dropColumn(['general_condition','gigi_tumbuh_pertama','long','weight','blood_pressure','pulse','temperature','breath_frequency','prebirth_weight','postbirth_weight','birth_long','birth_weight','head_size','arm_size','berguling_usia','duduk_usia','merangkak_usia','berdiri_usia','berjalan_usia','bicara_usia']);
        });
    }
}
