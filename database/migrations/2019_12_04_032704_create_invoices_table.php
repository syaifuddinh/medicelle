<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('registration_id')->nullable(false)->index();
            $table->integer('is_nota_rawat_jalan')->nullable(false)->default(0)->index();
            $table->integer('status')->nullable(false)->default(1)->index();
            $table->integer('qty')->nullable(false)->default(0)->index();
            $table->double('total')->nullable(false)->default(0)->index();
            $table->dateTime('paid_at')->nullable(true)->index();
            $table->unsignedInteger('paid_by')->nullable(true)->index();
            $table->timestamps();
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->foreign('registration_id')
              ->references('id')->on('registrations')
              ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
