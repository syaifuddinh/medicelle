<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssesmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assesments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('step')->nullable(false)->default(0)->index();
            $table->date('date')->nullable(false)->index();
            $table->unsignedInteger('registration_id')->nullable(false);
            $table->unsignedInteger('patient_id')->nullable(false);
            $table->unsignedInteger('created_by')->nullable(true);
            $table->unsignedInteger('updated_by')->nullable(true);

            $table->timestamps();

            $table->foreign('patient_id')
              ->references('id')->on('contacts')
              ->onDelete('restrict');

              $table->foreign('updated_by')
              ->references('id')->on('users')
              ->onDelete('restrict');
            $table->foreign('created_by')
              ->references('id')->on('users')
              ->onDelete('restrict');


            $table->foreign('registration_id')
              ->references('id')->on('registrations')
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
        Schema::dropIfExists('assesments');
    }
}
