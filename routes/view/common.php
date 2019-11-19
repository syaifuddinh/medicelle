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