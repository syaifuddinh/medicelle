<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 30)->index();
            $table->string('date')->index();
            $table->integer('status')->nullable(false)->default(1)->index();
            $table->enum('patient_type', ['UMUM', 'ASURANSI SWASTA'])->nullable(true)->index();
            $table->unsignedInteger('patient_id')->nullable(false);
            $table->unsignedInteger('created_by')->nullable(true);
            $table->unsignedInteger('updated_by')->nullable(true);
            $table->index('created_by', 'updated_by');

            $table->foreign('updated_by')
              ->references('id')->on('users')
              ->onDelete('restrict');
            $table->foreign('created_by')
              ->references('id')->on('users')
              ->onDelete('restrict');

            $table->foreign('patient_id')
              ->references('id')->on('contacts')
              ->onDelete('restrict');

            $table->timestamps();
        });
        
        Schema::create('registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('patient_type', ['UMUM', 'ASURANSI SWASTA'])->nullable(true)->index();
            $table->enum('family_type', ['ORANG TUA', 'DIRI SENDIRI', 'SUAMI/ISTRI', 'KELUARGA'])->nullable(true)->index();
            $table->string('code', 30)->nullable(false)->index();
            $table->string('insurance_code', 30)->nullable(true);
            $table->string('insurance_owner_name', 130)->nullable(true);
            $table->index('insurance_code', 'insurance_owner_name');
            $table->double('plafon')->nullable(false)->default(0)->index();
            $table->date('date')->nullable(false)->index();
            $table->integer('status')->nullable(false)->default(1)->index();
            $table->unsignedInteger('patient_id')->nullable(true)->index();
            $table->unsignedInteger('pic_id')->nullable(true)->index();
            $table->unsignedInteger('assesment_id')->nullable(true)->index();
            $table->unsignedInteger('medical_record_id')->nullable(true)->index();

            $table->foreign('patient_id')
              ->references('id')->on('contacts')
              ->onDelete('restrict');
            $table->timestamps();

            $table->foreign('pic_id')
              ->references('id')->on('contacts')
              ->onDelete('restrict');

            $table->unsignedInteger('created_by')->nullable(true);
            $table->unsignedInteger('updated_by')->nullable(true);
            
            $table->foreign('updated_by')
              ->references('id')->on('users')
              ->onDelete('restrict');
            $table->foreign('created_by')
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
        Schema::dropIfExists('registrations');
        Schema::dropIfExists('medical_records');
    }
}
