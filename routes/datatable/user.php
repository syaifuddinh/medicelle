<?php

Route::prefix('user')->group(function(){
    Route::get('notification', 'UserApiController@notification');
    Route::get('group_user', 'UserApiController@group_user');
    Route::get('user', 'UserApiController@user');
    Route::get('grup_nota', 'UserApiController@grup_nota');
    Route::get('price', 'UserApiController@price');
    Route::get('signa', 'UserApiController@signa');
    Route::get('laboratory_type', 'UserApiController@laboratory_type');
});

