<?php

Route::get('/', function (){
    return view('index');
})->name('home');


Route::name('notification.')->prefix('notification')
->group(function(){

    Route::get('/', function (){
        return view('user/notification/index');
    })->name('index');
});

Route::name('user.')->prefix('user')
->group(function(){

    Route::get('/', function (){
        return view('user/user/index');
    })->name('index');
    Route::get('/create', function (){
        return view('user/user/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('user/user/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('user/user/show')->withId($id);
    })->name('show');
});

Route::name('group_user.')->prefix('group_user')->group(function(){
    Route::get('/', function (){
        return view('user/group_user/index');
    })->name('index');
    Route::get('/create', function (){
        return view('user/group_user/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('user/group_user/create');
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('user/group_user/show')->withId($id);
    })->name('show');
});

Route::name('grup_nota.')->prefix('grup_nota')->group(function(){
    Route::get('/', function (){
        return view('user/grup_nota/index');
    })->name('index');
    Route::get('/create', function (){
        return view('user/grup_nota/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('user/grup_nota/create');
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('user/grup_nota/show')->withId($id);
    })->name('show');
});

Route::name('signa.')->prefix('signa')->group(function(){
    Route::get('/', function (){
        return view('user/signa/index');
    })->name('index');
    Route::get('/create', function (){
        return view('user/signa/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('user/signa/create');
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('user/signa/show')->withId($id);
    })->name('show');
});

Route::name('keadaan_umum.')->prefix('keadaan_umum')->group(function(){
    Route::get('/', function (){
        return view('user/keadaan_umum/index');
    })->name('index');
    Route::get('/create', function (){
        return view('user/keadaan_umum/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('user/keadaan_umum/create');
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('user/keadaan_umum/show')->withId($id);
    })->name('show');
});

Route::name('side_effect.')->prefix('side_effect')->group(function(){
    Route::get('/', function (){
        return view('user/side_effect/index');
    })->name('index');
    Route::get('/create', function (){
        return view('user/side_effect/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('user/side_effect/create');
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('user/side_effect/show')->withId($id);
    })->name('show');
});

Route::name('laboratory_type.')->prefix('laboratory_type')->group(function(){
    Route::get('/', function (){
        return view('user/laboratory_type/index');
    })->name('index');
    Route::get('/create', function (){
        return view('user/laboratory_type/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('user/laboratory_type/create');
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('user/laboratory_type/show')->withId($id);
    })->name('show');
});

Route::name('radiology_type.')->prefix('radiology_type')->group(function(){
    Route::get('/', function (){
        return view('user/radiology_type/index');
    })->name('index');
    Route::get('/create', function (){
        return view('user/radiology_type/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('user/radiology_type/create');
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('user/radiology_type/show')->withId($id);
    })->name('show');
});

Route::name('price.')->prefix('price')->group(function(){
    Route::get('/', function (){
        return view('user/price/index');
    })->name('index');
    Route::get('/administration', function (){
        return view('user/price/index');
    })->name('administration.index');
    Route::get('/sewa_alkes', function (){
        return view('user/price/index');
    })->name('sewa_alkes.index');
    Route::get('/sewa_ruangan', function (){
        return view('user/price/index');
    })->name('sewa_ruangan.index');
    Route::get('/treatment', function (){
        return view('user/price/index');
    })->name('treatment.index');
    Route::get('/diagnostic', function (){
        return view('user/price/index');
    })->name('diagnostic.index');
    Route::get('/sewa_instrumen', function (){
        return view('user/price/index');
    })->name('sewa_instrumen.index');

    Route::get('/pathology', function (){
        return view('user/price/index');
    })->name('pathology.index');

    Route::get('/create', function (){
        return view('user/price/create');
    })->name('create');
    Route::get('/administration/create', function (){
        return view('user/price/create');
    })->name('administration.create');
    Route::get('/sewa_ruangan/create', function (){
        return view('user/price/create');
    })->name('sewa_ruangan.create');
    Route::get('/sewa_alkes/create', function (){
        return view('user/price/create');
    })->name('sewa_alkes.create');
    Route::get('/treatment/create', function (){
        return view('user/price/create');
    })->name('treatment.create');
    Route::get('/diagnostic/create', function (){
        return view('user/price/create');
    })->name('diagnostic.create');
    Route::get('/sewa_instrumen/create', function (){
        return view('user/price/create');
    })->name('sewa_instrumen.create');
    Route::get('/pathology/create', function (){
        return view('user/price/create');
    })->name('pathology.create');

    Route::get('/edit/{id}', function ($id){
        return view('user/price/create');
    })->name('edit');
    Route::get('/administration/edit/{id}', function ($id){
        return view('user/price/create');
    })->name('administration.edit');
    Route::get('/sewa_ruangan/edit/{id}', function ($id){
        return view('user/price/create');
    })->name('sewa_ruangan.edit');
    Route::get('/sewa_alkes/edit/{id}', function ($id){
        return view('user/price/create');
    })->name('sewa_alkes.edit');
    Route::get('/treatment/edit/{id}', function ($id){
        return view('user/price/create');
    })->name('treatment.edit');
    Route::get('/diagnostic/edit/{id}', function ($id){
        return view('user/price/create');
    })->name('diagnostic.edit');
    Route::get('/sewa_instrumen/edit/{id}', function ($id){
        return view('user/price/create');
    })->name('sewa_instrumen.edit');

    Route::get('/pathology/edit/{id}', function ($id){
        return view('user/price/create');
    })->name('pathology.edit');

    Route::get('/{id}', function ($id){
        return view('user/price/show')->withId($id);
    })->name('show');
    Route::get('/administration/{id}', function ($id){
        return view('user/price/show')->withId($id);
    })->name('administration.show');
    Route::get('/sewa_ruangan/{id}', function ($id){
        return view('user/price/show')->withId($id);
    })->name('sewa_ruangan.show');
    Route::get('/sewa_alkes/{id}', function ($id){
        return view('user/price/show')->withId($id);
    })->name('sewa_alkes.show');
    Route::get('/treatment/{id}', function ($id){
        return view('user/price/show')->withId($id);
    })->name('treatment.show');
    Route::get('/diagnostic/{id}', function ($id){
        return view('user/price/show')->withId($id);
    })->name('diagnostic.show');
    Route::get('/sewa_instrumen/{id}', function ($id){
        return view('user/price/show')->withId($id);
    })->name('sewa_instrumen.show');
    Route::get('/pathology/{id}', function ($id){
        return view('user/price/show')->withId($id);
    })->name('pathology.show');
});

Route::name('treatment_group.')->prefix('treatment_group')->group(function(){
    Route::get('/', function (){
        return view('user/treatment_group/index');
    })->name('index');
    Route::get('/create', function (){
        return view('user/treatment_group/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('user/treatment_group/create');
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('user/treatment_group/show')->withId($id);
    })->name('show');
});
Route::name('setting.')->prefix('setting')->group(function(){
    Route::get('/general', function (){
        return view('user/setting/general');
    })->name('general');
    Route::get('/finance', function (){
        return view('user/setting/finance');
    })->name('finance');
});