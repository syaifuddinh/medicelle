<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Image;
use App\User;
use Str;
use Response;
use DB;
use File;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $request->validate([
            'code' => 'unique:users,code',
            'username' => 'unique:users,username',
            'email' => 'email',
        ], [
            'code.unique' => 'NIK sudah digunakan',
            'username.unique' => 'Username sudah digunakan',
            'email.email' => 'Masukkan email dengan benar !',
        ]);

        DB::beginTransaction();
        $filename = '';
        if($request->hasFile('avatar')) {
            $filename = date('YmdHis') . Str::random(5) . '.png';
            Image::make( file_get_contents( $request->avatar))->save(public_path('files/' . $filename));
        }
        $insert = $request->except('avatar');
        $insert['avatar'] = $filename;
        $user->fill($insert);
        $user->save();
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil di-input'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return Response::json($user::with('group_user')->find($user->id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'code' => 'unique:users,code,' . $user->id,
            'username' => 'unique:users,username,' . $user->id,
            'email' => 'email',
        ], [
            'code.unique' => 'NIK sudah digunakan',
            'username.unique' => 'Username sudah digunakan',
            'email.email' => 'Masukkan email dengan benar !',
        ]);
        DB::beginTransaction();
        $filename = $user->avatar;
        if($request->hasFile('avatar')) {
            if($user->avatar == null)
                File::delete(public_path('files/' . $user->avatar));
            $filename = date('YmdHis') . Str::random(5) . '.png';
            Image::make( $request->avatar)->save(public_path('files/' . $filename));
        }
        $insert = $request->except('avatar');
        $insert['avatar'] = $filename;
        $user->fill($insert);
        $user->save();
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        DB::beginTransaction();
        $user->is_active = 0;
        $user->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }

    public function activate(User $user)
    {
        //
        DB::beginTransaction();
        $user->is_active = 1;
        $user->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }
}
