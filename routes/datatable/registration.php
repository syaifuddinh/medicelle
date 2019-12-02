<?php

Route::prefix('registration')->group(function(){
    Route::get('registration', 'RegistrationApiController@registration');
    Route::get('medical_record/{patient_id}', 'RegistrationApiController@medical_record');
});

