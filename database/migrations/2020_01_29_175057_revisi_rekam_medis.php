<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RevisiRekamMedis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_records', function (Blueprint $table) {
            $table->string('pulse', 20)->nullable(false)->default(0)->change();
            $table->string('breath_frequency', 20)->nullable(false)->default(0)->change();
        });
        Schema::table('assesments', function (Blueprint $table) {
            $table->string('pulse', 20)->nullable(false)->default(0)->change();
            $table->string('breath_frequency', 20)->nullable(false)->default(0)->change();
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
            //
        });
    }
}
