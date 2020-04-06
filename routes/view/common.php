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
    Route::get('/create', function (){
        return view('user/price/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('user/price/create');
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('user/price/show')->withId($id);
    })->name('show');
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
    Route::get('/company', function (){
        return view('user/setting/company');
    })->name('company');
    Route::get('/finance', function (){
        return view('user/setting/finance');
    })->name('finance');
});