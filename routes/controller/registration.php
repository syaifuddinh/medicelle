<?php

Route::prefix('controller')->name('controller.')->group(function(){
    Route::prefix('registration')->namespace('Registration')->group(function(){
        Route::put('registration/attend/{id}', 'RegistrationController@attend');
        Route::put('registration/finish/{registration_detail_id}', 'RegistrationController@finish');
        Route::resource('registration', 'RegistrationController');

        Route::put('medical_record/{destination_id}/origin/{origin_id}', 'MedicalRecordController@clone');
        Route::resource('medical_record', 'MedicalRecordController');

        Route::put('assesment/{destination_id}/origin/{origin_id}', 'AssesmentController@clone');
        Route::resource('assesment', 'AssesmentController');

    });

});

