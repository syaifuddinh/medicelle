<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->nullable(false)->index();
            $table->string('title', 100)->nullable(false)->index();
            $table->text('description')->nullable(true)->index();
            $table->string('route', 100)->nullable(false)->index();
            $table->string('param', 100)->nullable(false)->default('[]')->index();
            $table->unsignedInteger('stock_id')->nullable(true)->index();
            $table->unsignedInteger('is_read')->nullable(false)->default(0)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
