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
        return view('registration/medical_record/create-2')->withId($id);
    })->name('edit.2');
    Route::get('/step/3/edit/{id}', function ($id){
        return view('registration/medical_record/create-3')->withId($id);
    })->name('edit.3');
    Route::get('/step/4/edit/{id}', function ($id){
        return view('registration/medical_record/create-4')->withId($id);
    })->name('edit.4');

    Route::get('/physique/general/{id}', function ($id){
        return view('registration/medical_record/create-physique-general')->withId($id);
    })->name('edit.physique.general');
    Route::get('/physique/head/{id}', function ($id){
        return view('registration/medical_record/create-physique-head')->withId($id);
    })->name('edit.physique.head');

    Route::get('/physique/breast/{id}', function ($id){
        return view('registration/medical_record/create-physique-breast')->withId($id);
    })->name('edit.physique.breast');
    Route::get('/physique/rectum/{id}', function ($id){
        return view('registration/medical_record/create-physique-rectum')->withId($id);
    })->name('edit.physique.rectum');


    Route::get('/step/1/show/{id}', function ($id){
        return view('registration/medical_record/show')->withId($id);
    })->name('show');
    Route::get('/step/2/show/{id}', function ($id){
        return view('registration/medical_record/show-2')->withId($id);
    })->name('show.2');
    Route::get('/step/3/show/{id}', function ($id){
        return view('registration/medical_record/show-3')->withId($id);
    })->name('show.3');
    Route::get('/step/4/show/{id}', function ($id){
        return view('registration/medical_record/show-4')->withId($id);
    })->name('show.4');
    
    Route::get('/{id}/patient', function (){
        return view('registration/medical_record/index');
    })->name('index');
});

Route::name('assesment.')->prefix('assesment')
->group(function(){

    Route::get('/step/1/edit/{id}', function ($id){
        return view('registration/assesment/create')->withId($id);
    })->name('edit');
    Route::get('/step/2/edit/{id}', function ($id){
        return view('registration/assesment/create-2')->withId($id);
    })->name('edit.2');
    Route::get('/step/3/edit/{id}', function ($id){
        return view('registration/assesment/create-3')->withId($id);
    })->name('edit.3');
    Route::get('/step/4/edit/{id}', function ($id){
        return view('registration/assesment/create-4')->withId($id);
    })->name('edit.4');


    Route::get('/step/1/show/{id}', function ($id){
        return view('registration/assesment/show')->withId($id);
    })->name('show');
    Route::get('/step/2/show/{id}', function ($id){
        return view('registration/assesment/show-2')->withId($id);
    })->name('show.2');
    Route::get('/step/3/show/{id}', function ($id){
        return view('registration/assesment/show-3')->withId($id);
    })->name('show.3');
    Route::get('/step/4/show/{id}', function ($id){
        return view('registration/assesment/show-4')->withId($id);
    })->name('show.4');
    
    Route::get('/{id}/patient', function (){
        return view('registration/assesment/index');
    })->name('index');
});
