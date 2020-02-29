<?php

Route::prefix('master')->group(function(){
    Route::get('patient', 'MasterApiController@patient');
    Route::get('specialization', 'MasterApiController@specialization');
    Route::get('polyclinic', 'MasterApiController@polyclinic');
    Route::get('piece', 'MasterApiController@piece');
    Route::get('lokasi', 'MasterApiController@lokasi');
    Route::get('doctor', 'MasterApiController@doctor');
    Route::get('nurse', 'MasterApiController@nurse');
    Route::get('nurse_helper', 'MasterApiController@nurse_helper');
    Route::get('discount', 'MasterApiController@discount');
    Route::get('actived_discount', 'MasterApiController@actived_discount');
    Route::get('supplier', 'MasterApiController@supplier');
    Route::get('agency', 'MasterApiController@agency');
    Route::get('employee', 'MasterApiController@employee');

    Route::get('disease_category', 'MasterApiController@disease_category');
    Route::get('disease', 'MasterApiController@disease');

    // Route::get('administration', 'MasterApiController@administration');
    // Route::get('laboratory', 'MasterApiController@laboratory');
    // Route::get('radiology', 'MasterApiController@radiology');

    Route::get('cure', 'MasterApiController@cure');
    Route::get('medical_item', 'MasterApiController@medical_item');
    Route::get('item', 'MasterApiController@item');
    Route::get('obat', 'MasterApiController@obat');
    Route::get('bhp/{flag?}', 'MasterApiController@bhp');
    Route::get('sewa_alkes/{flag?}', 'MasterApiController@sewa_alkes');
    Route::get('sewa_ruangan/{flag?}', 'MasterApiController@sewa_ruangan');
});

