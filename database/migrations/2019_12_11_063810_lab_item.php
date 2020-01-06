<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LabItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->integer('is_laboratory')->nullable(false)->default(0)->index();
            $table->unsignedInteger('piece_id')->nullable(true)->index();

             $table->foreign('piece_id')
              ->references('id')->on('pieces')
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
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['is_laboratory', 'piece_id']);
        });
    }
}
