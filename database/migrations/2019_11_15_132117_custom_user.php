<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomUser extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            // $table->string('username')->unique()->after('id');
            $table->unsignedInteger('group_user_id')->nullable(true)->after('username');
            $table->string('code', 30)->unique()->after('id');
            $table->string('fullname')->nullable(true)->after('name');
            $table->index('fullname');
            $table->integer('is_admin')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn(['group_user_id', 'code', 'fullname', 'is_admin']);
        });
    }
} 
