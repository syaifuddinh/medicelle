<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PermintaanPembelianInSettings extends Migration
{
    protected $params = [
        'name' => 'purchase_request',
        'content' => [
            'status' => [
                [
                    'id' => 1,
                    'name' => 'Draft'
                ],
                [
                    'id' => 2,
                    'name' => 'Disetujui APJ'
                ],
                [
                    'id' => 3,
                    'name' => 'Disetujui Direktur'
                ],
                [
                    'id' => 4,
                    'name' => 'Purchase Order Terbuat',
                    'is_approve' => 1
                ]
            ]
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
