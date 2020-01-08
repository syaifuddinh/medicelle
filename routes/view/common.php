<?php

Route::get('/', function (){
    return view('index');
})->name('home');


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
Route::name('setting.')->prefix('setting')->group(function(){
    Route::get('/company', function (){
        return view('user/setting/company');
    })->name('company');
    Route::get('/finance', function (){
        return view('user/setting/finance');
    })->name('finance');
});