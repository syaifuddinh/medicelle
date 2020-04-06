<?php

Route::prefix('controller')->name('controller.')->group(function(){
    Route::prefix('user')->namespace('User')->group(function(){
        Route::get('notification/unread', 'NotificationController@unreadNotif');
        Route::resource('notification', 'NotificationController');

        Route::put('group_user/activate/{permission}', 'PermissionController@activate');
        Route::resource('group_user', 'PermissionController');

        Route::put('grup_nota/activate/{permission}', 'GrupNotaController@activate');
        Route::resource('grup_nota', 'GrupNotaController');

        Route::put('keadaan_umum/activate/{permission}', 'KeadaanUmumController@activate');
        Route::resource('keadaan_umum', 'KeadaanUmumController');

        Route::put('signa/activate/{permission}', 'SignaController@activate');
        Route::resource('signa', 'SignaController');
        Route::get('signa/category/{flag?}', 'SignaController@index');

        Route::put('price/activate/{id}', 'PriceController@activate');
        Route::get('price/treatment', 'PriceController@treatment');
        Route::get('price/diagnostic', 'PriceController@diagnostic');
        Route::get('price/drug', 'PriceController@drug');
        Route::resource('price', 'PriceController');

        Route::put('user/activate/{user}', 'UserController@activate');
        Route::post('user/{user}', 'UserController@update');
        Route::resource('user', 'UserController');

        Route::put('treatment_group/activate/{id}', 'TreatmentGroupController@activate');
        Route::resource('treatment_group', 'TreatmentGroupController');

        Route::put('laboratory_type/activate/{id}', 'LaboratoryTypeController@activate');
        Route::post('laboratory_type/{id}', 'LaboratoryTypeController@update');
        Route::resource('laboratory_type', 'LaboratoryTypeController');

        Route::put('side_effect/activate/{id}', 'SideEffectController@activate');
        Route::post('side_effect/{id}', 'SideEffectController@update');
        Route::resource('side_effect', 'SideEffectController');

        Route::put('radiology_type/activate/{id}', 'RadiologyTypeController@activate');
        Route::post('radiology_type/{id}', 'RadiologyTypeController@update');
        Route::resource('radiology_type', 'RadiologyTypeController');

        Route::get('setting/company', 'SettingController@company');
        Route::get('setting/laboratory', 'SettingController@laboratory');
        Route::put('setting/laboratory/grid', 'SettingController@store_grid');
        Route::get('setting/finance', 'SettingController@finance');
        Route::put('setting/store_company', 'SettingController@store_company');
        Route::put('setting/store_finance', 'SettingController@store_finance');
        Route::post('setting/store_logo', 'SettingController@store_logo');
        Route::post('setting/store_logo/{flag}', 'SettingController@store_logo');
    });
});

