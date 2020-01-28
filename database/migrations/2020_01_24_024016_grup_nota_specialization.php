<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GrupNotaSpecialization extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('specializations', function (Blueprint $table) {
            $table->text('grup_nota_roles')->nullable(false)->default('[]');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('specializations', function (Blueprint $table) {
            $table->dropColumn(['grup_nota_roles']);
        });
    }
}
