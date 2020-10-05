<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('is_discount_off')->nullable(false)->default(0)->index();
            $table->unsignedInteger('created_by')->nullable(false);
            $table->unsignedInteger('contact_id')->nullable(false);
            $table->date('date')->nullable(false)->index();
            $table->double('debet')->nullable(false)->default(0);
            $table->double('credit')->nullable(false)->default(0);
            $table->double('leftover')->nullable(false)->default(0);
            $table->timestamps();
            $table->text('description')->nullable(true);
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');
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
        Schema::dropIfExists('payments');
    }
}
