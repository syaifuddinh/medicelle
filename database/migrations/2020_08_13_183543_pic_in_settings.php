<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PicInSettings extends Migration
{
    protected $params = [
        'name' => 'pic',
        'content' => [
            'radiology' => [],
            'laboratory' => [],
            'chemoterapy' => [],
            'pathology' => [],
            'pharmacy' => [],
            'purchase_request_approval' => [],
            'purchase_order_approval' => []
        ]
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
        Schema::table('settings', function (Blueprint $table) {
            DB::table('settings')
            ->whereName($this->params['name'])
            ->delete();
        });
    }
}
