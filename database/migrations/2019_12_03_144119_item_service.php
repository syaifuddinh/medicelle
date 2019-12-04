<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('item_id')->nullable(false);
            $table->unsignedInteger('grup_nota_id')->nullable(false);
            $table->string('destination', 25)->nullable(true)->index();
            $table->unsignedInteger('polyclinic_id')->nullable(true);
            $table->integer('is_registration')->nullable(false)->default(0);
            $table->integer('qty')->nullable(false)->default(1)->index();
            $table->integer('is_active')->nullable(false)->default(1);

            $table->index(['item_id', 'grup_nota_id', 'polyclinic_id']);
            $table->index(['is_registration', 'is_active']);
            $table->unsignedInteger('created_by')->nullable(false);
            $table->timestamps();
        });
        Schema::table('prices', function (Blueprint $table) {
            $table->foreign('item_id')
              ->references('id')->on('items')
              ->onDelete('restrict');
            $table->foreign('grup_nota_id')
              ->references('id')->on('permissions')
              ->onDelete('restrict');
            $table->foreign('created_by')
              ->references('id')->on('users')
              ->onDelete('restrict');
            $table->foreign('polyclinic_id')
              ->references('id')->on('polyclinics')
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
        Schema::dropIfExists('prices');
    }
}
