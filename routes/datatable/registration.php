<?php

Route::prefix('registration')->group(function(){
    Route::get('registration', 'RegistrationApiController@registration');
    Route::get('polyclinic_registered/{flag?}', 'RegistrationApiController@polyclinic_registered');
    
    Route::get('radiology_registered/{flag?}', 'RegistrationApiController@radiology_registered');
    Route::get('chemoterapy_registered/{flag?}', 'RegistrationApiController@chemoterapy_registered');

    Route::get('polyclinic_medical_record/{patient_id}', 'RegistrationApiController@polyclinic_medical_record');
    Route::get('radiology_medical_record/{patient_id}', 'RegistrationApiController@radiology_medical_record');
    Route::get('chemoterapy_medical_record/{patient_id}', 'RegistrationApiController@chemoterapy_medical_record');

    Route::get('assesment/{patient_id}', 'RegistrationApiController@assesment');
});

