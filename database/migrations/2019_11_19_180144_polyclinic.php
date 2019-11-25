<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Polyclinic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polyclinics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 30)->unique();
            $table->string('name', 200)->index();
            $table->integer('index')->nullable(false)->default(0);
            $table->string('cost_center', 30)->nullable(true)->index();
            $table->integer('is_active')->nullable(false)->default(1);
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
        Schema::dropIfExists('polyclinics');
    }
}
