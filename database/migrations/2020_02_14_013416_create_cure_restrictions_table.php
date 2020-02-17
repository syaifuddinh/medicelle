<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCureRestrictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cure_restrictions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('category_id')->nullable(false)->index();
            $table->unsignedInteger('is_allow_classification')->nullable(false)->default(1)->index();
            $table->unsignedInteger('is_allow_subclassification')->nullable(false)->default(1)->index();
            $table->unsignedInteger('is_allow_generic')->nullable(false)->default(1)->index();
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
        Schema::dropIfExists('cure_restrictions');
    }
}
