<?php

Route::prefix('controller')->name('controller.')->group(function(){
    Route::prefix('user')->namespace('User')->group(function(){
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

        Route::get('setting/company', 'SettingController@company');
        Route::put('setting/store_company', 'SettingController@store_company');
        Route::post('setting/store_logo', 'SettingController@store_logo');
    });
});

