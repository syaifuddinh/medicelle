<?php

Route::prefix('registration')->group(function(){
    Route::get('registration', 'RegistrationApiController@registration');
});

