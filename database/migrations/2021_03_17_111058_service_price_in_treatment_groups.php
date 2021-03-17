<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ServicePriceInTreatmentGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('treatment_groups', function (Blueprint $table) {
            $table->double('service_price')->nullable(false)->default(0);
            $table->double('reduksi')->nullable(false)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('treatment_groups', function (Blueprint $table) {
            $table->dropColumn(['service_price']);
            $table->dropColumn(['reduksi']);
        });
    }
}
