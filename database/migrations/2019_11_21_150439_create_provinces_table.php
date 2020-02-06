<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 30)->index();            
            $table->timestamps();
        });

        DB::table("provinces")->insert([
            ['id' => 1, 'name' => 'Nanggroe Aceh Darussalam'],
            ['id' => 2, 'name' => 'Sumatera Utara'],
            ['id' => 3, 'name' => 'Sumatera Barat'],
            ['id' => 4, 'name' => 'Riau'],
            ['id' => 5, 'name' => 'Kepulauan Riau'],
            ['id' => 6, 'name' => 'Kepulauan Bangka-Belitung'],
            ['id' => 7, 'name' => 'Jambi'],
            ['id' => 8, 'name' => 'Bengkulu'],
            ['id' => 9, 'name' => 'Sumatera Selatan'],
            ['id' => 10, 'name' => 'Lampung'],
            ['id' => 11, 'name' => 'Banten'],
            ['id' => 12, 'name' => 'DKI Jakarta'],
            ['id' => 13, 'name' => 'Jawa Barat'],
            ['id' => 14, 'name' => 'Jawa Tengah'],
            ['id' => 15, 'name' => 'Daerah Istimewa Yogyakarta  '],
            ['id' => 16, 'name' => 'Jawa Timur'],
            ['id' => 17, 'name' => 'Bali'],
            ['id' => 18, 'name' => 'Nusa Tenggara Barat'],
            ['id' => 19, 'name' => 'Nusa Tenggara Timur'],
            ['id' => 20, 'name' => 'Kalimantan Barat'],
            ['id' => 21, 'name' => 'Kalimantan Tengah'],
            ['id' => 22, 'name' => 'Kalimantan Selatan'],
            ['id' => 23, 'name' => 'Kalimantan Timur'],
            ['id' => 24, 'name' => 'Gorontalo'],
            ['id' => 25, 'name' => 'Sulawesi Selatan'],
            ['id' => 26, 'name' => 'Sulawesi Tenggara'],
            ['id' => 27, 'name' => 'Sulawesi Tengah'],
            ['id' => 28, 'name' => 'Sulawesi Utara'],
            ['id' => 29, 'name' => 'Sulawesi Barat'],
            ['id' => 30, 'name' => 'Maluku'],
            ['id' => 31, 'name' => 'Maluku Utara'],
            ['id' => 32, 'name' => 'Papua Barat'],
            ['id' => 33, 'name' => 'Papua'],
            ['id' => 34, 'name' => 'Kalimantan Utara']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provinces');
    }
}
