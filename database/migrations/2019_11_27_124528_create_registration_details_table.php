<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('registration_id')->nullable(false);
            $table->string('destination', 25)->nullable(false);
            $table->unsignedInteger('polyclinic_id')->nullable(true);
            $table->unsignedInteger('doctor_id')->nullable(true);
            $table->time('time')->nullable(false);
            $table->timestamps();

            $table->foreign('registration_id')
              ->references('id')->on('registrations')
              ->onDelete('cascade');

            $table->foreign('doctor_id')
              ->references('id')->on('contacts')
              ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registration_details');
    }
}
