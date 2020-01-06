<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 50)->nullable(false)->index();
            $table->string('option', 20)->nullable(true)->index();
            $table->unsignedInteger('medical_record_id')->nullable(false)->index();
            $table->unsignedInteger('doctor_id')->nullable(false)->index();
            $table->unsignedInteger('created_by')->nullable(false)->index();
            $table->unsignedInteger('updated_by')->nullable(true)->index();
            $table->date('date')->nullable(false)->index();
            $table->date('review_date')->nullable(true)->index();
            $table->date('start_date')->nullable(true)->index();
            $table->date('end_date')->nullable(true)->index();
            $table->integer('duration')->nullable(true);
            $table->enum('duration_type', ['MINGGU', 'BULAN'])->nullable(true);
            $table->integer('age')->nullable(true);
            $table->enum('age_type', ['MINGGU', 'BULAN'])->nullable(true);
            $table->text('description')->nullable(true);
            $table->text('additional')->nullable(false)->default('{}');
            $table->integer('is_cuti_hamil')->nullable(false)->default(0)->index();
            $table->integer('is_keterangan_dokter')->nullable(false)->default(0)->index();
            $table->integer('is_keterangan_sehat')->nullable(false)->default(0)->index();
            $table->integer('is_layak_terbang')->nullable(false)->default(0)->index();
            $table->integer('is_pengantar_mrs')->nullable(false)->default(0)->index();
            $table->integer('is_rujukan_pasien')->nullable(false)->default(0)->index();

            $table->timestamps();
            $table->foreign('medical_record_id')
              ->references('id')->on('medical_records')
              ->onDelete('restrict');
            $table->foreign('created_by')
              ->references('id')->on('users')
              ->onDelete('restrict');
            $table->foreign('updated_by')
              ->references('id')->on('users')
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
        Schema::dropIfExists('letters');
    }
}
