<?php

Route::prefix('controller')->name('controller.')->group(function(){
    Route::prefix('pharmacy')->name('pharmacy.')->namespace('Pharmacy')->group(function(){
        Route::get('purchase_request/{id}/pdf', 'PurchaseRequestController@pdf')->name('purchase_request.pdf');
        Route::resource('purchase_request', 'PurchaseRequestController');

        Route::get('stock_transaction/check', 'StockTransactionController@check')->name('stock_transaction.check');
    });
});

