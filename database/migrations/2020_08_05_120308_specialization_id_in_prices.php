<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpecializationIdInPrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prices', function (Blueprint $table) {
            $table->unsignedInteger('specialization_id')
            ->nullable(true)
            ->index();
            $table->unsignedInteger('is_specialization')
            ->nullable(false)
            ->default(0)
            ->index();

            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prices', function (Blueprint $table) {
            $table->dropForeign(['specialization_id']);
            $table->dropColumn(['specialization_id', 'is_specialization']);
        });
    }
}
