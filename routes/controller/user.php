<?php

Route::prefix('controller')->name('controller.')->group(function(){
    Route::prefix('user')->namespace('User')->group(function(){
        Route::put('group_user/activate/{permission}', 'PermissionController@activate');
        Route::resource('group_user', 'PermissionController');

        Route::put('grup_nota/activate/{permission}', 'GrupNotaController@activate');
        Route::resource('grup_nota', 'GrupNotaController');

        Route::put('price/activate/{permission}', 'PriceController@activate');
        Route::resource('price', 'PriceController');

        Route::put('user/activate/{user}', 'UserController@activate');
        Route::post('user/{user}', 'UserController@update');
        Route::resource('user', 'UserController');
    });
});

