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
    Route::get('/{id}/{pivot_medical_record_id}', function ($id) use($flag){
        $registration = App\Registration::find($id);
        return view('polyclinic/polyclinic/show')->withId($id)->with('patient_id', $registration->patient_id)->with('medical_record_id', $registration->medical_record_id)->withFlag($flag);
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
    Route::get('/{id}/{pivot_medical_record_id}', function ($id) use($flag){
        $registration = App\Registration::find($id);
        return view('polyclinic/polyclinic/show')
        ->withId($id)
        ->with('patient_id', $registration->patient_id)
        ->with('medical_record_id', $registration->medical_record_id)
        ->withFlag($flag);
    })->name('show');
});

Route::name('laboratory.')->prefix('laboratory/patient')
->group(function(){

    $flag = 'laboratory';
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
    Route::get('/{id}/{pivot_medical_record_id}', function ($id) use($flag){
        $registration = App\Registration::find($id);
        return view('polyclinic/polyclinic/show')->withId($id)->with('patient_id', $registration->patient_id)->with('medical_record_id', $registration->medical_record_id)->withFlag($flag);
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
    Route::get('/{id}/{pivot_medical_record_id}', function ($id) use($flag){
        $registration = App\Registration::find($id);
        return view('polyclinic/polyclinic/show')->withId($id)->with('patient_id', $registration->patient_id)->with('medical_record_id', $registration->medical_record_id)->withFlag($flag);
    })->name('show');
});

Route::name('ruang_tindakan.')->prefix('ruang_tindakan/patient')
->group(function(){

    $flag = 'ruang_tindakan';
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
    Route::get('/{id}/{pivot_medical_record_id}', function ($id) use($flag){
        $registration = App\Registration::find($id);
        return view('polyclinic/polyclinic/show')->withId($id)->with('patient_id', $registration->patient_id)->with('medical_record_id', $registration->medical_record_id)->withFlag($flag);
    })->name('show');
});

Route::name('medical_checkup.')->prefix('medical_checkup/patient')
->group(function(){

    $flag = 'medical_checkup';
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
    Route::get('/{id}/{pivot_medical_record_id}', function ($id) use($flag){
        $registration = App\Registration::find($id);
        return view('polyclinic/polyclinic/show')->withId($id)->with('patient_id', $registration->patient_id)->with('medical_record_id', $registration->medical_record_id)->withFlag($flag);
    })->name('show');
});




