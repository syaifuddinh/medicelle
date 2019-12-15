<?php

Route::name('polyclinic.patient.')->prefix('polyclinic/patient')
->group(function(){

    $flag = 'polyclinic.patient';
    Route::get('/', function () use($flag){
        return view('polyclinic/polyclinic/index')->withFlag($flag);
    })->name('index');
    Route::get('/history', function () use($flag){
        return view('polyclinic/polyclinic/history')->withFlag($flag);
    })->name('history');
    Route::get('/create', function (){
        return view('polyclinic/polyclinic/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('polyclinic/polyclinic/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        $registration = App\Registration::find($id);
        return view('polyclinic/polyclinic/show')->withId($id)->with('patient_id', $registration->patient_id);
    })->name('show');
});


Route::name('radiology.')->prefix('radiology/patient')
->group(function(){

    $flag = 'radiology';
    Route::get('/', function () use($flag){
        return view('polyclinic/polyclinic/index')->withFlag($flag);
    })->name('index');
    Route::get('/history', function () use($flag){
        return view('polyclinic/polyclinic/history')->withFlag($flag);
    })->name('history');
    Route::get('/create', function (){
        return view('polyclinic/polyclinic/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('polyclinic/polyclinic/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        $registration = App\Registration::find($id);
        return view('polyclinic/polyclinic/show')->withId($id)->with('patient_id', $registration->patient_id);
    })->name('show');
});


Route::name('chemoterapy.')->prefix('chemoterapy/patient')
->group(function(){

    $flag = 'chemoterapy';
    Route::get('/', function () use($flag){
        return view('polyclinic/polyclinic/index')->withFlag($flag);
    })->name('index');
    Route::get('/history', function () use($flag){
        return view('polyclinic/polyclinic/history')->withFlag($flag);
    })->name('history');
    Route::get('/create', function (){
        return view('polyclinic/polyclinic/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('polyclinic/polyclinic/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        $registration = App\Registration::find($id);
        return view('polyclinic/polyclinic/show')->withId($id)->with('patient_id', $registration->patient_id);
    })->name('show');
});




