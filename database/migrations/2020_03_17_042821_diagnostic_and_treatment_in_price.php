<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DiagnosticAndTreatmentInPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prices', function (Blueprint $table) {
            $table->integer('is_treatment')
            ->nullable(false)
            ->default(0)
            ->after('is_registration')
            ->index();
            $table->integer('is_diagnostic')
            ->nullable(false)
            ->default(0)
            ->after('is_registration')
            ->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prices', function (Blueprint $table) {
            $table->dropColumn([['is_treatment', 'is_diagnostic']]);
        });
    }
}
