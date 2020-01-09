<?php

Route::prefix('controller')->name('controller.')->group(function(){
    Route::prefix('cashier')->namespace('Cashier')->group(function(){
        Route::put('cashier/pay/{id}', 'CashierController@pay');
        Route::get('cashier/{id}/pdf', 'CashierController@pdf');
        Route::resource('cashier', 'CashierController');


    });

});

