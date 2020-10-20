<?php

Route::prefix('report')->group(function(){
    Route::get('doctor_service', 'ReportApiController@doctor_service');    
    Route::get('medical_bill', 'ReportApiController@medical_bill');    
    Route::get('medical_payment', 'ReportApiController@medical_payment');    
});

