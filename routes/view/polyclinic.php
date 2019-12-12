<?php

Route::name('polyclinic.')->prefix('polyclinic')
->group(function(){

    Route::get('/', function (){
        return view('polyclinic/polyclinic/index');
    })->name('index');
    Route::get('/history', function (){
        return view('polyclinic/polyclinic/history');
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




