<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IsChemoterapyPivotMedicalRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pivot_medical_records', function (Blueprint $table) {
            $table->integer('is_chemoterapy')
            ->nullable(false)
            ->default(0)
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
        Schema::table('pivot_medical_records', function (Blueprint $table) {
            $table->dropColumn(['is_chemoterapy']);
        });
    }
}
