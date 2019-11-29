<?php

Route::prefix('controller')->name('controller.')->group(function(){
    Route::prefix('master')->namespace('Master')->group(function(){
        Route::get('city', 'CityController@index');
        Route::get('district', 'DistrictController@index');
        Route::get('village', 'VillageController@index');

        Route::put('specialization/activate/{specialization}', 'SpecializationController@activate');
        Route::resource('specialization', 'SpecializationController');

        Route::put('polyclinic/activate/{polyclinic}', 'PolyclinicController@activate');
        Route::resource('polyclinic', 'PolyclinicController');

        Route::put('discount/activate/{discount}', 'DiscountController@activate');
        Route::resource('discount', 'DiscountController');

        Route::put('piece/activate/{piece}', 'PieceController@activate');
        Route::resource('piece', 'PieceController');

        Route::put('supplier/activate/{id}', 'SupplierController@activate');
        Route::resource('supplier', 'SupplierController');

        Route::put('agency/activate/{id}', 'AgencyController@activate');
        Route::resource('agency', 'AgencyController');

        Route::put('doctor/activate/{id}', 'DoctorController@activate');
        Route::resource('doctor', 'DoctorController');

        Route::put('nurse/activate/{id}', 'NurseController@activate');
        Route::resource('nurse', 'NurseController');

        Route::put('nurse_helper/activate/{id}', 'NurseHelperController@activate');
        Route::resource('nurse_helper', 'NurseHelperController');

        Route::put('employee/activate/{id}', 'EmployeeController@activate');
        Route::resource('employee', 'EmployeeController');

        Route::put('patient/activate/{id}', 'PatientController@activate');
        Route::resource('patient', 'PatientController');

        Route::put('disease/activate/{id}', 'DiseaseController@activate');
        Route::resource('disease', 'DiseaseController');

        Route::put('disease_category/activate/{id}', 'DiseaseCategoryController@activate');
        Route::resource('disease_category', 'DiseaseCategoryController');
    });
});

