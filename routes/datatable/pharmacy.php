<?php

Route::prefix('pharmacy')->group(function(){
    Route::get('discount_off_payment', 'PharmacyApiController@discount_off_payment');    
    Route::get('purchase_request', 'PharmacyApiController@purchase_request');    
    Route::get('purchase_order', 'PharmacyApiController@purchase_order');    
    Route::get('receipt', 'PharmacyApiController@receipt');    
    Route::get('movement', 'PharmacyApiController@movement');    
    Route::get('adjustment_stock', 'PharmacyApiController@adjustment_stock');    
    Route::get('formula', 'PharmacyApiController@formula');    
    Route::get('distribution', 'PharmacyApiController@distribution');    
    Route::get('discount_off', 'PharmacyApiController@discount_off');    
    Route::get('history', 'PharmacyApiController@history');    
});

