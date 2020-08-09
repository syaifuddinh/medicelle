<?php

namespace App\Http\Controllers\User;

use App\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;
use App\Permission;

class RolesController extends Controller
{
    public function read($params = []) {
        $group_user_id = $params['group_user_id'] ?? null; 
        $hide_level = $params['hide_level'] ?? []; 
        $has_route = $params['has_route'] ?? false; 
        $filter = [];
        if($group_user_id) {
            $permission = Permission::find($group_user_id);
            if($permission != null) {
                $used = $permission->roles;
                foreach($used as $i => $u) {
                    if($u == 1) {
                        $filter[] = $i;
                    }
                }
            } 
        }

        $roles = DB::table('roles')
        ->whereNull('roles.parent_id')
        ->orderBy('roles.order', 'ASC');
        if($group_user_id) {
            $roles->whereIn('roles.slug', $filter);
        }
        if($has_route === true) {
            $roles->whereNotNull('roles.route');
        }

        if(!in_array(2, $hide_level)) {
            $roles2 = DB::table('roles AS roles2')
            ->whereLevel(2)
            ->groupBy('roles2.id')
            ->orderBy('roles2.order', 'ASC')
            ->select(
                'roles2.id', 
                'roles2.slug', 
                'roles2.name', 
                'roles2.parent_id'
            );
            if($has_route === true) {
                $roles2->whereNotNull('roles2.route');
            }
            if(!in_array(3, $hide_level)) {
                $roles2->addSelect(DB::raw('array_to_json(array_agg(row_to_json(roles3))) AS level3'));
            }

            if($group_user_id) {
                $roles2->whereIn('roles2.slug', $filter);
            }

            if(!in_array(3, $hide_level)) {
                $roles3 = DB::table('roles AS roles3')
                ->whereLevel(3)
                ->orderBy('roles3.order', 'ASC')
                ->select('roles3.id', 'roles3.slug', 'roles3.name', 'roles3.parent_id');
                if($group_user_id) {
                    $roles3->whereIn('roles3.slug', $filter);
                }
                if($has_route === true) {
                    $roles3->whereNotNull('roles3.route');
                }

                $roles2->leftJoinSub($roles3, 'roles3', function($join){
                    $join->on('roles2.id', 'roles3.parent_id');
                });
            }

            $roles->leftJoinSub($roles2, 'roles2', function($join){
                $join->on('roles.id', 'roles2.parent_id');
            });
        }

        $roles->groupBy('roles.id')
        ->select(
            'roles.id', 
            'roles.slug', 
            'roles.name'
        );
        if(!in_array(2, $hide_level)) {
            $roles->addSelect(DB::raw('array_to_json(array_agg(row_to_json(roles2))) AS level2'));
        }
        $roles = $roles->get();
        $roles = $roles->map(function($e){
            $e->level2 = json_decode($e->level2);
            return $e;
        });

        return $roles ?? [];
    }

    public function index()
    {
        $roles = $this->read();
        return Response::json($roles, 200);
    }
}
