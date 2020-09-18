<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdditionalInAssesments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assesments', function (Blueprint $table) {
            $table->json('additional')->nullable(false)->default('{}');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assesments', function (Blueprint $table) {
            $table->dropColumn(['assesments']);
        });
    }
}
