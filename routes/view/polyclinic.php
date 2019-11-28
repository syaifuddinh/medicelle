<?php

Route::name('assesment.')->prefix('assesment')
->group(function(){

    Route::get('/', function (){
        return view('polyclinic/assesment/index');
    })->name('index');
    Route::get('/create', function (){
        return view('polyclinic/assesment/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('polyclinic/assesment/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('polyclinic/assesment/show')->withId($id);
    })->name('show');
});
