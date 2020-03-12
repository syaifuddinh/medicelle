<?php

Route::prefix('controller')->name('controller.')->group(function(){
    Route::prefix('user')->namespace('User')->group(function(){
        Route::get('notification/unread', 'NotificationController@unreadNotif');
        Route::resource('notification', 'NotificationController');

        Route::put('group_user/activate/{permission}', 'PermissionController@activate');
        Route::resource('group_user', 'PermissionController');

        Route::put('grup_nota/activate/{permission}', 'GrupNotaController@activate');
        Route::resource('grup_nota', 'GrupNotaController');

        Route::put('signa/activate/{permission}', 'SignaController@activate');
        Route::resource('signa', 'SignaController');
        Route::get('signa/category/{flag?}', 'SignaController@index');

        Route::put('price/activate/{permission}', 'PriceController@activate');
        Route::get('price/treatment', 'PriceController@treatment');
        Route::get('price/drug', 'PriceController@drug');
        Route::resource('price', 'PriceController');

        Route::put('user/activate/{user}', 'UserController@activate');
        Route::post('user/{user}', 'UserController@update');
        Route::resource('user', 'UserController');

        Route::put('laboratory_type/activate/{id}', 'LaboratoryTypeController@activate');
        Route::post('laboratory_type/{id}', 'LaboratoryTypeController@update');
        Route::resource('laboratory_type', 'LaboratoryTypeController');

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

