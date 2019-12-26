<?php

Route::prefix('controller')->name('controller.')->group(function(){
    Route::prefix('registration')->namespace('Registration')->group(function(){
        Route::put('registration/attend/{id}', 'RegistrationController@attend');
        Route::put('registration/finish/{registration_detail_id}', 'RegistrationController@finish');
        Route::resource('registration', 'RegistrationController');

        Route::get('medical_record/{id}/next_schedule', 'MedicalRecordController@next_schedule');
        Route::get('medical_record/{id}/schedule', 'MedicalRecordController@schedule');
        Route::get('medical_record/{id}/refer_doctor/{doctor_id}', 'MedicalRecordController@refer_doctor');
        Route::get('medical_record/{id}/doctor', 'MedicalRecordController@doctor');
        Route::get('medical_record/{id}/pdf', 'MedicalRecordController@pdf');
        Route::post('medical_record/submit_research/{id}/{flag?}', 'MedicalRecordController@submit_research');
        Route::post('medical_record/update_research/{medical_record_detail_id}/', 'MedicalRecordController@update_research');
        Route::post('medical_record/submit_schedule/{id}', 'MedicalRecordController@submit_schedule');
        Route::put('medical_record/{destination_id}/origin/{origin_id}', 'MedicalRecordController@clone');
        Route::delete('medical_record/detail/{id}', 'MedicalRecordController@destroy_detail');
        Route::resource('medical_record', 'MedicalRecordController');

        Route::put('assesment/{destination_id}/origin/{origin_id}', 'AssesmentController@clone');
        Route::resource('assesment', 'AssesmentController');

    });

});

