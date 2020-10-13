<?php

Route::prefix('report')->group(function(){
    Route::get('medical_bill', 'ReportApiController@medical_bill');    
    Route::get('medical_payment', 'ReportApiController@medical_payment');    
});

