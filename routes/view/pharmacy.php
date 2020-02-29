<?php

Route::name('pharmacy.')->prefix('pharmacy')
->group(function(){
    
    Route::name('purchase_request.')->prefix('purchase_request')
    ->group(function(){

        Route::get('/', function (){
            return view('pharmacy/purchase_request/index');
        })->name('index');
        Route::get('/create', function (){
            return view('pharmacy/purchase_request/create');
        })->name('create');
        Route::get('/edit/{id}', function ($id){
            return view('pharmacy/purchase_request/create')->withId($id);
        })->name('edit');
        Route::get('/{id}', function ($id){
            return view('pharmacy/purchase_request/show')->withId($id);
        })->name('show');
    });

});
