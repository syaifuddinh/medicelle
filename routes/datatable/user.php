<?php

Route::prefix('user')->group(function(){
    Route::get('group_user', 'UserApiController@group_user');
    Route::get('user', 'UserApiController@user');
});

