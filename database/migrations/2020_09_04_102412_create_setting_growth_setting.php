<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingGrowthSetting extends Migration
{
    protected $params = [
        'name' => 'children_growth',
        'content' => []
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        for($x = 0;$x < 36;$x++) {
            $this->params['content'][] = [
                'berat' => [
                    'batas_bawah' => 0,
                    'batas_normal' => 0,
                    'batas_atas' => 0
                ],
                'panjang' => [
                    'batas_bawah' => 0,
                    'batas_normal' => 0,
                    'batas_atas' => 0
                ],
            ];
        }

        DB::table('settings')
        ->insert([
            'name' => $this->params['name'],
            'content' => json_encode($this->params['content'])
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')
        ->whereName($this->params['name'])
        ->delete();
    }
}
