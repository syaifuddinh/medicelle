<?php

Route::prefix('pharmacy')->group(function(){
    Route::get('purchase_request', 'PharmacyApiController@purchase_request');    
    Route::get('purchase_order', 'PharmacyApiController@purchase_order');    
    Route::get('receipt', 'PharmacyApiController@receipt');    
    Route::get('movement', 'PharmacyApiController@movement');    
    Route::get('stock_transaction', 'PharmacyApiController@stock_transaction');    
    Route::get('stock', 'PharmacyApiController@stock');    
});

