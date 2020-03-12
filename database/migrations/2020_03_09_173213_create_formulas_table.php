<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable(false)->index();
            $table->unsignedInteger('medical_record_id')->nullable(false)->index();
            $table->unsignedInteger('registration_detail_id')->nullable(false)->index();
            $table->unsignedInteger('invoice_id')->nullable(true)->index();
            $table->unsignedInteger('is_approve')->nullable(false)->default(0)->index();
            $table->unsignedInteger('updated_by')->nullable(true)->index();
            $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('set null');
            $table->foreign('medical_record_id')->references('id')->on('medical_records')->onDelete('restrict');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('registration_detail_id')->references('id')->on('registration_details')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formulas');
    }
}
