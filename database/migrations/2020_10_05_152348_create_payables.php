<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable(false)->index();
            $table->unsignedInteger('contact_id')
            ->nullable(false)
            ->index();
            $table->integer('is_paid')->nullable(false)->default(0);
            $table->integer('qty')->nullable(false)->default(0);
            $table->double('price')->nullable(false)->default(0);
            $table->integer('discount')->nullable(false)->default(0);
            $table->double('discount_value')->nullable(false)->default(0);
            $table->double('total_price')->nullable(false)->default(0);
            $table->double('total_discount_value')->nullable(false)->default(0);
            $table->double('grandtotal')->nullable(false)->default(0);
            $table->unsignedInteger('receipt_detail_id')->nullable(true);
            $table->timestamps();

            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payables');
    }
}
