<?php

Route::prefix('registration')->group(function(){
    Route::get('registration', 'RegistrationApiController@registration');
    Route::get('polyclinic_registered', 'RegistrationApiController@polyclinic_registered');
    Route::get('polyclinic_medical_record/{patient_id}', 'RegistrationApiController@polyclinic_medical_record');
    Route::get('assesment/{patient_id}', 'RegistrationApiController@assesment');
});

