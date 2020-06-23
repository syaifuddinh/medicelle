<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitDoctorRole extends Migration
{
    public function __construct() {
        $this->roles = [
            [
                'name' => 'Dokter Poliklinik',
                'slug' => 'polyclinic'
            ],
            [
                'name' => 'Dokter Radiologi',
                'slug' => 'radiology'
            ],
            [
                'name' => 'Dokter Laboratorium',
                'slug' => 'laboratory'
            ],
            [
                'name' => 'Dokter Ruang Tindakan',
                'slug' => 'ruang_tindakan'
            ],
            [
                'name' => 'Dokter Kemoterapi',
                'slug' => 'chemoterapy'
            ],
            [
                'name' => 'Dokter Medical Checkup',
                'slug' => 'medical_checkup'
            ]
        ];
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach($this->roles as $role) {
            $role_access = [
                $role['slug'] => "1",
                $role['slug'] . '.show' => "1",
                $role['slug'] . '.edit' => "1",
                $role['slug'] . '.finish' => "1"
            ];
            DB::table('permissions')
            ->insert([
                'is_permission' => 1,
                'name' => $role['name'],
                'slug' => str_replace(' ', '_', strtolower($role['name'])),
                'roles' =>  json_encode($role_access)
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach($this->roles as $role) {
            DB::table('permissions')
            ->whereIsPermission(1)
            ->whereName($role['name'])
            ->delete();
        }
    }
}
