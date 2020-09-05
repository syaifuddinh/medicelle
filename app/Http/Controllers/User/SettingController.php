<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Setting;
use Str;
use Response;
use DB;
use File;
use Image;

class SettingController extends Controller
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
    public function store_company(Request $request)
    {
        $request->validate([
            'company.name' => 'required',
        ], [
            'company.name.required' => 'Nama tidak boleh kosong',
        ]);

        DB::beginTransaction();
        $setting = Setting::whereName('company');
        $content = $setting->first()->content;
        $logo = $content->logo;
        $insert = $request->company;
        $insert['logo'] = str_replace(asset('files') . '/', '', $logo);
        $setting->update([
            'content' => json_encode($insert)
        ]);   
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil di-input'], 200);
    }

    public function store_finance(Request $request)
    {
        DB::beginTransaction();
        $setting = Setting::whereName('finance');
        $json = $request->finance;
        $content = $setting->first()->content;
        foreach($json as $key => $unit) {
            $content->{$key} = $unit;
        } 

        $setting->update([
            'content' => json_encode($content)
        ]);   
        DB::commit();
        return Response::json(['message' => 'Transaksi berhasil di-input'], 200);
    }

    public function store_logo(Request $request, $flag = null) {
        $filename = '';
        if($request->hasFile('logo') && $flag == null) {
            $filename = date('YmdHis') . Str::random(5) . '.png';
            Image::make( file_get_contents( $request->logo))->save(public_path('files/' . $filename));
        } else if($request->hasFile('logo2') && $flag == 2) {
            $filename = date('YmdHis') . Str::random(5) . '.png';
            Image::make( file_get_contents( $request->logo2))->save(public_path('files/' . $filename));
        }

        $setting = Setting::whereName('company');
        $content = $setting->first()->content;
        if($flag == null) {
            $content->logo = $filename;
            $content->logo2 = preg_replace('/.+files\/(.*)/', '$1', $content->logo2);
        } else if($flag == 2) {
            $content->logo2 = $filename;
            $content->logo = preg_replace('/.+files\/(.*)/', '$1', $content->logo);
        }
        $setting->update([
            'content' => json_encode($content)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function company()
    {
        $company = Setting::whereName('company')->first()->content;
        
        return Response::json($company, 200);
    }

    public function pic()
    {
        $pic = $this->fetch('pic');
        return Response::json($pic, 200);
    }

    public function purchase_request()
    {
        $purchase_request = $this->fetch('purchase_request');
        return Response::json($purchase_request, 200);
    }

    public static function fetch($slug) {
        $setting = Setting::whereName($slug)->first()->content;
        return $setting;
    }

    public function updatePic(Request $request, $slug)
    {
        $request->validate([
            'contact_id' => 'required'
        ], [
            'contact_id.required' => 'Tenaga medis tidak boleh kosong'
        ]);

        $pic = (array) Setting::whereName('pic')->first()->content;
        $related = $pic[$slug];
        if(in_array($request->contact_id, $related)) {
            $key = array_search($request->contact_id, $related);
            array_splice($related, $key, 1);
        } else {
            array_push($related, $request->contact_id);
        }
        $pic[$slug] = $related;
        Setting::whereName('pic')
        ->update([
            'content' => json_encode($pic)
        ]);
        
        return Response::json(['message' => 'Data berhasil disimpan'], 200);
    }

    public function laboratory()
    {
        $laboratory = Setting::whereName('laboratory')->first()->content;
        
        return Response::json($laboratory, 200);
    }

    public function store_grid(Request $request)
    {
        $laboratory = Setting::whereName('laboratory');
        $content = $laboratory->first()->content;
        $content->grid_amount =$request->grid_amount ?? 1;
        $laboratory->update([
            'content' => json_encode($content)
        ]);
        
        return Response::json(['message' => 'Grid berhasil di-update'], 200);
    }

    public function finance()
    {
        $finance = Setting::whereName('finance')->first()->content;
        
        return Response::json($finance, 200);
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

    public function showPic() {
        $resp = [
            [
                'slug' => 'radiology',
                'name' => 'Radiologi'
            ],
            [
                'slug' => 'laboratory',
                'name' => 'Laboratorium'
            ],
            [
                'slug' => 'pathology',
                'name' => 'Patologi & Anatomi'
            ],
            [
                'slug' => 'chemoterapy',
                'name' => 'Kemoterapi'
            ],
            [
                'slug' => 'pharmacy',
                'name' => 'Farmasi'
            ],
            [
                'slug' => 'purchase_request_approval',
                'name' => 'Approval Permintaan Pembelian'
            ],
            [
                'slug' => 'purchase_order_approval',
                'name' => 'Approval Order Pembelian'
            ]
        ];

        return Response::json($resp);
    }

    public function showChildrenGrowth() {
        $children_growth = Setting::whereName('children_growth')->first()->content;
        
        return Response::json($children_growth, 200);
    }

    public function storeChildrenGrowth(Request $request) {
        $content = Setting::whereName('children_growth')->first()->content;
        if($request->filled('index')) {
            $content[$request->index] = $request->value;
            Setting::whereName('children_growth')
            ->update([
                'content' => json_encode($content)
            ]);
            return Response::json(['message' => 'Data berhasil disimpan'], 200);
        }
        
        return Response::json(['message' => 'Tidak ada data yang disimpan'], 421);
    }
}
