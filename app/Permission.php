<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends Model
{
    //
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['roles'];
    protected $guarded = ['id'];

    public static function boot() {
        parent::boot();

        static::creating(function(Permission $permission){
            if($permission->is_permission == 1 || $permission->is_signa == 1 || $permission->is_lokasi == 1 || $permission->is_keadaan_umum == 1)
                $permission->slug = Str::random() . Str::snake($permission->name);
        });

        static::created(function(Permission $permission){
            if($permission->is_lokasi == 1) {
                if($permission->is_gudang_farmasi == 1) {
                    Permission::where('id', '!=', $permission->id)
                    ->whereIsLokasi(1)
                    ->update([
                        'is_gudang_farmasi' => 0
                    ]);
                } else {
                    $gudang_farmasi_count = Permission::whereIsLokasi(1) 
                    ->whereIsActive(1)
                    ->whereIsGudangFarmasi(1)
                    ->count('id');

                    if($gudang_farmasi_count == 0) {
                        $latest_lokasi_id = Permission::whereIsLokasi(1)
                        ->max('id');

                        Permission::whereId($latest_lokasi_id)
                        ->update([
                            'is_gudang_farmasi' => 1
                        ]);
                    }
                }
            }
        });

        static::updating(function(Permission $permission){
            if($permission->is_permission == 1 || $permission->is_signa == 1 || $permission->is_lokasi == 1)
                $permission->slug = Str::random(3) . Str::snake($permission->name);


            if($permission->is_gudang_farmasi == 1 AND $permission->is_active == 1) {
                Permission::where('id', '!=', $permission->id)
                ->whereIsLokasi(1)
                ->update([
                    'is_gudang_farmasi' => 0
                ]);
            } else {
                $gudang_farmasi_count = Permission::whereIsLokasi(1) 
                ->whereIsActive(1)
                ->whereIsGudangFarmasi(1)
                ->count('id');

                if($gudang_farmasi_count == 0) {
                    $latest_lokasi_id = Permission::whereIsLokasi(1)
                    ->max('id');

                    Permission::whereId($latest_lokasi_id)
                    ->update([
                        'is_gudang_farmasi' => 1
                    ]);
                }
            }
        });
    } 

    static function gudang_farmasi() {
        $gudang_farmasi = self::whereIsLokasi(1)
        ->whereIsGudangFarmasi(1)
        ->select('id', 'name')
        ->first();

        return $gudang_farmasi;
    }

    public function getRolesAttribute(){ 
        if(array_key_exists('roles', $this->attributes)) {
            return json_decode($this->attributes['roles']);
        }
        return null;
    }
}
