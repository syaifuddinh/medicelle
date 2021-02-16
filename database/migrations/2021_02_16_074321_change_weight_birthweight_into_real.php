<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeWeightBirthweightIntoReal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assesment_details', function (Blueprint $table) {
            //
		$table->decimal('weight')->change();
        });
        Schema::table('assesments', function (Blueprint $table) {
            //
		$table->text('jumlah_pemakaian_pembalut')->change();
        });
        Schema::table('medical_record_details', function (Blueprint $table) {
            //
		$table->decimal('weight')->change();
        });
        Schema::table('medical_records', function (Blueprint $table) {
            //
		$table->decimal('weight')->change();
		$table->decimal('birth_weight')->change();
		$table->decimal('prebirth_weight')->change();
		$table->decimal('postbirth_weight')->change();
		$table->text('jumlah_pemakaian_pembalut')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assesment_details', function (Blueprint $table) {
            //
        });
    }
}
