<?php

Route::prefix('cashier')->group(function(){
    Route::get('cashier', 'CashierApiController@cashier');
});

