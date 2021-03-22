<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnMedicalRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_records', function (Blueprint $table) {
            $table->text('allergy_history')->nullable(true);
            $table->text('obgyn_allergy_history')->nullable(true);
            $table->text('family_disease_history')->nullable(true);
            $table->text('obgyn_family_disease_history')->nullable(true);
            $table->text('cure_history')->nullable(true);
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
            $table->dropColumn(['allergy_history']);
            $table->dropColumn(['obgyn_allergy_history']);
            $table->dropColumn(['family_disease_history']);
            $table->dropColumn(['obgyn_family_disease_history']);
            $table->dropColumn(['cure_history']);
        });
    }
}
