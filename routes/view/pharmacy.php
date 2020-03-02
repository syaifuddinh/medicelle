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
    
    Route::name('purchase_order.')->prefix('purchase_order')
    ->group(function(){

        Route::get('/', function (){
            return view('pharmacy/purchase_order/index');
        })->name('index');
        Route::get('/{id}', function ($id){
            return view('pharmacy/purchase_order/show')->withId($id);
        })->name('show');
    });
    
    Route::name('receipt.')->prefix('receipt')
    ->group(function(){

        Route::get('/', function (){
            return view('pharmacy/receipt/index');
        })->name('index');

        Route::get('/purchase_order/{purchase_order_id}/create', function (){
            return view('pharmacy/receipt/create');
        })->name('create');

        Route::get('/{id}', function ($id){
            return view('pharmacy/receipt/show')->withId($id);
        })->name('show');
    });

});
