<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Permission;
use App\User;
use DataTables;

class UserApiController extends Controller
{
    public function group_user(Request $request) {
        $x = Permission::select('id', 'name', 'is_active', 'description');
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }

    public function user(Request $request) {
        $x = User::with('group_user')->select('id', 'code', 'name', 'is_active', 'group_user_id');
        $x = $request->filled('is_active') ? $x->whereIsActive($request->is_active) : $x;
        if($request->filled('group_user_id')) {
            $x = $x->whereGroupUserId($request->group_user_id);
        }
        if($request->draw == 1)
            $x->orderBy('id', 'DESC');

        return Datatables::eloquent($x)->make(true);
    }
}
