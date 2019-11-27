<?php

Route::prefix('master')->group(function(){
    Route::get('patient', 'MasterApiController@patient');
    Route::get('specialization', 'MasterApiController@specialization');
    Route::get('polyclinic', 'MasterApiController@polyclinic');
    Route::get('piece', 'MasterApiController@piece');
    Route::get('doctor', 'MasterApiController@doctor');
    Route::get('nurse', 'MasterApiController@nurse');
    Route::get('nurse_helper', 'MasterApiController@nurse_helper');
    Route::get('discount', 'MasterApiController@discount');
    Route::get('supplier', 'MasterApiController@supplier');
    Route::get('agency', 'MasterApiController@agency');
    Route::get('employee', 'MasterApiController@employee');
});

