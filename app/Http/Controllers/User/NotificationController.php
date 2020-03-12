<?php

namespace App\Http\Controllers\User;

use App\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;
use Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notification = Notification::select('id', 'title', 'description', 'route', 'param', 'is_read')
        ->whereUserId(Auth::user()->id)
        ->whereIsRead(0);
        if($request->filled('limit')) {
            $notification =  $notification
            ->skip(0)
            ->limit($request->limit);
        }

        $notification = $notification
        ->orderBy('id', 'desc')
        ->get();
        return Response::json($notification, 200);
    }

    public function unreadNotif()
    {
        Notification::generateExpiredCure();
        $notification = Notification::whereUserId(Auth::user()->id)
        ->whereIsRead(0)
        ->count('id');
        return Response::json($notification, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Notification $notification)
    {
        DB::beginTransaction();
        $notification->fill($request->all());
        $notification->is_grup_nota = 1;
        $notification->save();
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil diinput'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->is_read = 1;
        $notification->save();
        return Response::json($notification, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification, $id)
    {
        DB::beginTransaction();
        $notification = $notification->findOrFail($id);
        $notification->fill($request->all());
        $notification->save();
        DB::commit();

        return Response::json(['message' => 'Transaksi berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification, $id)
    {
        DB::beginTransaction();
        $notification = $notification->find($id);
        $notification->is_active = 0;
        $notification->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil dinon-aktifkan'], 200);
    }
    public function activate(Notification $notification)
    {
        DB::beginTransaction();
        $notification->is_active = 1;
        $notification->save();
        DB::commit();

        return Response::json(['message' => 'Data berhasil diaktifkan'], 200);
    }
}
