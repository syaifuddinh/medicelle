<?php

Route::name('registration.')->prefix('registration')
->group(function(){

    Route::get('/', function (){
        return view('registration/registration/index');
    })->name('index');
    Route::get('/create', function (){
        return view('registration/registration/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('registration/registration/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('registration/registration/show')->withId($id);
    })->name('show');
});
