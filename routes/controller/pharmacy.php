<?php

Route::prefix('controller')->name('controller.')->group(function(){
    Route::prefix('pharmacy')->name('pharmacy.')->namespace('Pharmacy')->group(function(){

        Route::get('purchase_request/{id}/pdf', 'PurchaseRequestController@pdf')->name('purchase_request.pdf');
        Route::put('purchase_request/{id}/approve', 'PurchaseRequestController@approve')->name('purchase_request.approve');
        Route::resource('purchase_request', 'PurchaseRequestController');

        Route::get('formula/{id}/pdf', 'FormulaController@pdf')->name('formula.pdf');
        Route::put('formula/{id}/approve', 'FormulaController@approve')->name('formula.approve');
        Route::resource('formula', 'FormulaController');

        Route::get('purchase_order/{id}/pdf', 'PurchaseOrderController@pdf')->name('purchase_order.pdf');
        Route::put('purchase_order/{id}/approve', 'PurchaseOrderController@approve')->name('purchase_order.approve');
        Route::resource('purchase_order', 'PurchaseOrderController');

        Route::resource('receipt', 'ReceiptController');

        Route::get('stock_transaction/check', 'StockTransactionController@check')
        ->middleware(['compareDate'])
        ->name('stock_transaction.check');

        Route::get('stock_transaction/lokasi/check', 'StockTransactionController@check_by_lokasi');

        Route::get('stock_transaction/item/check', 'StockTransactionController@check_by_item');

        Route::resource('movement', 'MovementController');
        Route::resource('adjustment_stock', 'AdjustmentStockController');
    });
});

