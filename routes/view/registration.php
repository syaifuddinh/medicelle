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

Route::name('medical_record.')->prefix('medical_record')
->group(function(){

    Route::get('/step/1/edit/{id}', function ($id){
        return view('registration/medical_record/create')->withId($id);
    })->name('edit');
    Route::get('/step/2/edit/{id}', function ($id){
        return view('registration/medical_record/create')->withId($id);
    })->name('edit.2');
    Route::get('/step/3/edit/{id}', function ($id){
        return view('registration/medical_record/create')->withId($id);
    })->name('edit.3');
    Route::get('/{id}', function ($id){
        return view('registration/medical_record/show')->withId($id);
    })->name('show');
});
