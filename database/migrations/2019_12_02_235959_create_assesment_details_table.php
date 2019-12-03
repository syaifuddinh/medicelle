<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssesmentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assesment_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('assesment_id')->nullable(false)->index();
            $table->unsignedInteger('disease_id')->nullable(true)->index();
            $table->string('cure', 200)->nullable(true)->index();
            $table->date('last_checkup_date')->nullable(true)->index();

            $table->string('pain_location', 200)->nullable(true)->index();
            $table->integer('is_other_pain_type')->nullable(false)->default(0);
            $table->string('pain_type', 70)->nullable(true)->index();
            $table->string('pain_duration', 70)->nullable(true)->index();
            $table->string('emergence_time', 70)->nullable(true)->index();
            $table->string('side_effect', 170)->nullable(true)->index();

            $table->integer('is_unknown')->nullable(false)->default(0)->index();
            $table->integer('is_allergy_history')->nullable(false)->default(0)->index();
            $table->integer('is_disease_history')->nullable(false)->default(0)->index();
            $table->integer('is_family_disease_history')->nullable(false)->default(0)->index();
            $table->integer('is_pain_history')->nullable(false)->default(0)->index();
            $table->integer('is_pain_cure_history')->nullable(false)->default(0)->index();

            $table->integer('is_kid_history')->nullable(false)->default(0)->index();
            $table->integer('is_pregnant_week_age')->nullable(false)->default(0)->index();
            $table->integer('kid_order')->nullable(false)->default(0)->index();
            $table->integer('partus_year')->nullable(false)->default(0)->index();
            $table->string('partus_location', 100)->nullable(true);
            $table->integer('pregnant_month_age')->nullable(false)->default(0)->index();
            $table->integer('pregnant_week_age')->nullable(false)->default(0)->index();
            $table->string('birth_type', 30)->nullable(true);
            $table->string('birth_helper', 80)->nullable(true);
            $table->string('birth_obstacle', 150)->nullable(true);
            $table->enum('baby_gender', ['PRIA', 'WANITA'])->nullable(true);
            $table->integer('weight')->nullable(false)->default(0)->index();
            $table->integer('long')->nullable(false)->default(0)->index();
            $table->string('komplikasi_nifas', 150)->nullable(true);

            $table->integer('is_imunisasi_history')->nullable(false)->default(0)->index();
            $table->integer('is_other_imunisasi')->nullable(false)->default(0)->index();
            $table->integer('imunisasi_year_age')->nullable(false)->default(0)->index();
            $table->integer('imunisasi_month_age')->nullable(false)->default(0)->index();
            $table->integer('is_imunisasi_month_age')->nullable(false)->default(0)->index();
            $table->string('imunisasi', 150)->nullable(true);
            $table->string('reaksi_imunisasi', 300)->nullable(true);

            $table->timestamps();

            $table->foreign('disease_id')
              ->references('id')->on('items')
              ->onDelete('restrict');
            $table->foreign('assesment_id')
              ->references('id')->on('assesments')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assesment_details');
    }
}
