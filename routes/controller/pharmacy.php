<?php

Route::prefix('controller')->name('controller.')->group(function(){
    Route::prefix('pharmacy')->name('pharmacy.')->namespace('Pharmacy')->group(function(){

        Route::resource('equipment', 'EquipmentController');
        Route::get('equipment/{id}/pdf', 'EquipmentController@pdf')->name('equipment.pdf');
        Route::resource('equipment/{equipment_id}/detail', 'EquipmentDetailController');
        Route::put('equipment/{equipment_id}/detail/{id}/approve', 'EquipmentDetailController@approve');

        Route::get('purchase_request/{id}/pdf', 'PurchaseRequestController@pdf')->name('purchase_request.pdf');
        Route::put('purchase_request/{id}/approve', 'PurchaseRequestController@approve')->name('purchase_request.approve');
        Route::resource('purchase_request', 'PurchaseRequestController');

        Route::resource('discount_off_payment', 'DiscountOffPaymentController');

        Route::get('formula/{id}/pdf', 'FormulaController@pdf')->name('formula.pdf');
        Route::put('formula/{id}/approve', 'FormulaController@approve')->name('formula.approve');
        Route::put('formula/{id}/reject', 'FormulaController@reject')->name('formula.reject');
        Route::put('formula/{id}/rollback', 'FormulaController@rollback')->name('formula.rollback');
        Route::resource('formula', 'FormulaController');

        Route::get('purchase_order/{id}/pdf', 'PurchaseOrderController@pdf')->name('purchase_order.pdf');
        Route::put('purchase_order/{id}/approve', 'PurchaseOrderController@approve')->name('purchase_order.approve');
        Route::resource('purchase_order', 'PurchaseOrderController');

        Route::get('receipt/{id}/pdf', 'ReceiptController@pdf')->name('receipt.pdf');
        Route::resource('receipt', 'ReceiptController');

        Route::get('stock_transaction/check', 'StockTransactionController@check')
        ->middleware(['compareDate'])
        ->name('stock_transaction.check');

        Route::get('stock_transaction/lokasi/check', 'StockTransactionController@check_by_lokasi');
        Route::get('stock_transaction/lokasi/checkBHP', 'StockTransactionController@check_by_lokasiBHP');

        Route::get('stock_transaction/item/check', 'StockTransactionController@check_by_item');

        Route::resource('movement', 'MovementController');
        Route::resource('adjustment_stock', 'AdjustmentStockController');
    });
});

