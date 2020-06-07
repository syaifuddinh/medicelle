<?php

Route::name('cashier.')->prefix('cashier')
->group(function(){

    Route::get('/', function (){
        return view('cashier/cashier/index');
    })->name('index');
    Route::get('/create', function (){
        return view('cashier/cashier/create');
    })->name('create');
    Route::get('/pay/{id}', function ($id){
        return view('cashier/cashier/create')->withId($id);
    })->name('pay');
    Route::get('/pay/{id}/amandemen', function ($id){
        return view('cashier/cashier/create')->withId($id);
    })->name('amandemen');
    Route::get('/{id}', function ($id){
        return view('cashier/cashier/show')->withId($id);
    })->name('show');
});

