<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSideEffectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('side_effects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200)
            ->nullable(false)
            ->index();
            $table->string('is_active', 200)
            ->nullable(false)
            ->default(1)
            ->index();
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
        Schema::dropIfExists('side_effects');
    }
}
