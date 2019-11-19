<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('is_active')->nullable(false)->default(1);
            $table->foreign('group_user_id')
              ->references('id')->on('permissions')
              ->onDelete('restrict');
        });
        DB::table('users')->update(['is_admin' => 1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['group_user_id']);
            $table->dropColumn(['is_active']);
        });
    }
}
