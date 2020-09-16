<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseRequestLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_request_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('purchase_request_id')
            ->nullable(false)
            ->index();
            $table->unsignedInteger('status')
            ->nullable(false)
            ->index();
            $table->unsignedInteger('created_by')
            ->nullable(false)
            ->index();
            $table->timestamps();

            $table->foreign('purchase_request_id')->references('id')->on('purchase_requests')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_request_logs');
    }
}
