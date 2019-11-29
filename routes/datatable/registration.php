<?php

Route::prefix('registration')->group(function(){
    Route::get('registration', 'RegistrationApiController@registration');
    Route::get('medical_record', 'RegistrationApiController@medical_record');
});

