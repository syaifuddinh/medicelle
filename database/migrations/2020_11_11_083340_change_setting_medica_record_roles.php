<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSettingMedicaRecordRoles extends Migration
{
    protected $content = '[{"name":"Anamnesa","child":[{"name":"anamnesa","label":"Anamnesa"},{"name":"anamnesa_obgyn","label":"Anamnesa(Obgyn)"}]},{"name":"Pemeriksaan fisik","child":[{"name":"umum","label":"Umum"},{"name":"children","label":"Anak"},{"name":"kepala","label":"Kepala & leher"},{"name":"breast","label":"Breast(Payudata)"},{"name":"rectum","label":"Rectum & anal canal"},{"name":"children_growth","label":"Grafik pertumbuhan anak"}]},{"name":"Medical Checkup","child":[{"name":"medical_checkup","label":"Medical Checkup"}]},{"name":"Terapi","child":[{"name":"tindakan","label":"Tindakan"},{"name":"diagnostik","label":"Diagnostik"},{"name":"obat","label":"Obat"}]},{"name":"BHP, Sewa ruang, & Alkes","child":[{"name":"bhp","label":"BHP"},{"name":"sewa_alkes","label":"Sewa alkes"},{"name":"sewa_ruangan","label":"Sewa ruangan"}]},{"name":"Permintaan","child":[{"name":"fnab","label":"FNAB"},{"name":"histopatologi","label":"Histopatologi"},{"name":"papsmear","label":"Papsmear"},{"name":"sitologi","label":"Sitologi"}]},{"name":"Radiologi","child":[{"name":"radiologi","label":"Radiologi"}]},{"name":"Laboratorium","child":[{"name":"laboratorium","label":"Laboratorium"}]},{"name":"Patologi & anatomi","child":[{"name":"patologi","label":"Patologi & anatomi"}]},{"name":"Jadwal kontrol","child":[{"name":"jadwal_kontrol","label":"Jadwal kontrol"}]},{"name":"Resume medis","child":[{"name":"resume_medis","label":"Resume medis"}]},{"name":"Riwayat Assesment","child":[{"name":"assesment","label":"Riwayat Assesment"}]}]';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')
        ->whereName('medical_record_roles')
        ->update([
            'content' => $this->content
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
