<?php

Route::prefix('controller')->name('controller.')->group(function(){
    Route::prefix('registration')->namespace('Registration')->group(function(){
        Route::put('registration/attend/{id}', 'RegistrationController@attend');
        Route::put('registration/finish/{registration_detail_id}', 'RegistrationController@finish');
        Route::get('registration/{registration_id}/{registration_detail_id}', 'RegistrationController@detail');
        Route::resource('registration', 'RegistrationController');

        Route::get('medical_record/pivot/{pivot_medical_record_id}', 'MedicalRecordController@pivot');
        Route::put('medical_record/pivot/{pivot_medical_record_id}/ruang_tindakan/description', 'MedicalRecordController@update_ruang_tindakan_description');

        Route::put('medical_record/pivot/{pivot_medical_record_id}/laboratory_form', 'MedicalRecordController@update_laboratory_form');
        Route::get('medical_record/pivot/{pivot_medical_record_id}/laboratory_form/pdf', 'MedicalRecordController@laboratory_form_pdf');

        Route::put('medical_record/pivot/{pivot_medical_record_id}/laboratory', 'MedicalRecordController@update_laboratory');
        Route::put('medical_record/pivot/{pivot_medical_record_id}/additional', 'MedicalRecordController@update_additional_pivot');
        Route::get('medical_record/pivot/{pivot_medical_record_id}/ruang_tindakan/pdf', 'MedicalRecordController@ruang_tindakan_pdf');
        Route::get('medical_record/pivot/{pivot_medical_record_id}/laboratory/pdf', 'MedicalRecordController@laboratory_pdf');

        Route::get('medical_record/pivot/{pivot_medical_record_id}/usg_mammae/pdf', 'MedicalRecordController@usg_mammae_pdf');
        Route::get('medical_record/pivot/{pivot_medical_record_id}/usg_thyroid/pdf', 'MedicalRecordController@usg_thyroid_pdf');
        Route::get('medical_record/pivot/{pivot_medical_record_id}/mammografi/pdf', 'MedicalRecordController@mammografi_pdf');
        Route::get('medical_record/pivot/{pivot_medical_record_id}/radiology/pdf', 'MedicalRecordController@radiology_pdf');
        Route::get('medical_record/pivot/{pivot_medical_record_id}/chemoterapy/pdf', 'MedicalRecordController@chemoterapy_pdf');
        Route::get('medical_record/pivot/{pivot_medical_record_id}/xray/pdf', 'MedicalRecordController@xray_pdf');
        Route::get('medical_record/pivot/{pivot_medical_record_id}/usg_abdomen_upper_lower_pria/pdf', 'MedicalRecordController@usg_abdomen_upper_lower_pria_pdf');
        Route::get('medical_record/pivot/{pivot_medical_record_id}/usg_abdomen_upper_lower_wanita/pdf', 'MedicalRecordController@usg_abdomen_upper_lower_wanita_pdf');

        Route::post('medical_record/{id}/detail', 'MedicalRecordController@store_detail');
        Route::get('medical_record/{id}/fnab/pdf', 'MedicalRecordController@fnab_pdf');
        Route::get('medical_record/{id}/histopatologi/pdf', 'MedicalRecordController@histopatologi_pdf');
        Route::get('medical_record/{id}/papsmear/pdf', 'MedicalRecordController@papsmear_pdf');
        Route::get('medical_record/{id}/sitologi/pdf', 'MedicalRecordController@sitologi_pdf');
        Route::get('medical_record/{id}/next_schedule', 'MedicalRecordController@next_schedule');
        Route::get('medical_record/{id}/schedule', 'MedicalRecordController@schedule');
        Route::get('medical_record/{id}/refer_doctor/{doctor_id}', 'MedicalRecordController@refer_doctor');
        Route::get('medical_record/{id}/doctor', 'MedicalRecordController@doctor');
        Route::post('medical_record/{id}/store_signature/{flag}', 'MedicalRecordController@store_signature');
        Route::get('medical_record/{id}/pdf/{flag?}', 'MedicalRecordController@pdf');
        Route::get('medical_record/{id}/docx', 'MedicalRecordController@docx');
        Route::post('medical_record/submit_research/{id}/{flag?}', 'MedicalRecordController@submit_research');
        Route::post('medical_record/update_research/{medical_record_detail_id}/', 'MedicalRecordController@update_research');
        Route::post('medical_record/submit_schedule/{id}', 'MedicalRecordController@submit_schedule');
        Route::put('medical_record/{destination_id}/origin/{origin_id}', 'MedicalRecordController@clone');
        Route::delete('medical_record/{id}/detail/{detail_id}', 'MedicalRecordController@destroy_detail');
        Route::resource('medical_record', 'MedicalRecordController');

        Route::put('assesment/{destination_id}/origin/{origin_id}', 'AssesmentController@clone');
        Route::resource('assesment', 'AssesmentController');

    });

});

