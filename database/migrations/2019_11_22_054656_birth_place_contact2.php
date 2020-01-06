<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BirthPlaceContact2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            //
            $table->string('birth_place', '60')->nullable(true);
            $table->enum('marriage_status', ['MENIKAH', 'BELUM MENIKAH', 'DUDA', 'JANDA'])->nullable(true)->index();

        });

        Schema::table('users', function (Blueprint $table) {
            //
            $table->unsignedInteger('contact_id')->nullable(true)->index();
            $table->foreign('contact_id')
              ->references('id')->on('contacts')
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
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['birth_place', 'marriage_status']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['contact_id']);
            $table->dropColumn(['contact_id']);
        });
    }
}
