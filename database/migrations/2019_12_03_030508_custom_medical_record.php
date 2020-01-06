<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomMedicalRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_records', function (Blueprint $table) {
            $table->unsignedInteger('registration_detail_id')->after('id')->nullable(false)->index();
            $table->unsignedInteger('registration_id')->after('id')->nullable(false)->index();
        });
        Schema::table('medical_records', function (Blueprint $table) {
            $table->foreign('registration_id')
              ->references('id')->on('registrations')
              ->onDelete('cascade');

            $table->foreign('registration_detail_id')
              ->references('id')->on('registration_details')
              ->onDelete('cascade');
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
            $table->dropColumn(['registration_id', 'registration_detail_id']);

        });
    }
}
