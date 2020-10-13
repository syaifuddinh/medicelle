<?php

Route::prefix('report')->group(function(){
    Route::get('medical_bill', 'ReportApiController@medical_bill');    
});

