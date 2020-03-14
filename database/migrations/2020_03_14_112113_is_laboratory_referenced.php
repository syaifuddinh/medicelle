<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IsLaboratoryReferenced extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pivot_medical_records', function (Blueprint $table) {
            $table->unsignedInteger('is_laboratory_treatment')->nullable(false)->default(0)->index();
            $table->unsignedInteger('parent_id')->nullable(true)->index();

            $table->foreign('parent_id')->references('id')->on('pivot_medical_records')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pivot_medical_records', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn(['is_laboratory_treatment', 'parent_id']);
        });
    }
}
