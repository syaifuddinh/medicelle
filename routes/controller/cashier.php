<?php

Route::prefix('controller')->name('controller.')->group(function(){
    Route::prefix('cashier')
    ->name('cashier.')
    ->namespace('Cashier')
    ->group(function(){
        Route::put('cashier/pay/{id}', 'CashierController@pay');
        Route::get('cashier/{id}/pdf', 'CashierController@pdf')
        ->name('pdf');
        Route::put('cashier/{id}/amandemen', 'CashierController@amandemen');
        Route::resource('cashier', 'CashierController');


    });

});

