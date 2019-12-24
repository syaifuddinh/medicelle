<?php

Route::prefix('controller')->name('controller.')->group(function(){
    Route::prefix('master')->namespace('Master')->group(function(){
        Route::get('province', 'CityController@province');
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
        Route::get('piece/actived', 'PieceController@actived');
        Route::resource('piece', 'PieceController');


        Route::put('lokasi/activate/{lokasi}', 'LokasiController@activate');
        Route::get('lokasi/actived', 'LokasiController@actived');
        Route::resource('lokasi', 'LokasiController');

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

        Route::put('administration/activate/{id}', 'AdministrationController@activate');
        Route::get('administration/category', 'AdministrationController@category');
        Route::get('administration/category/actived', 'AdministrationController@actived_category');
        Route::get('administration/actived', 'AdministrationController@actived');
        Route::resource('administration', 'AdministrationController');

        Route::put('laboratory/activate/{id}', 'LaboratoryController@activate');
        Route::get('laboratory/category', 'LaboratoryController@category');
        Route::get('laboratory/category/actived', 'LaboratoryController@actived_category');
        Route::get('laboratory/actived', 'LaboratoryController@actived');
        Route::resource('laboratory', 'LaboratoryController');

        Route::put('radiology/activate/{id}', 'RadiologyController@activate');
        Route::get('radiology/category', 'RadiologyController@category');
        Route::get('radiology/category/actived', 'RadiologyController@actived_category');
        Route::get('radiology/actived', 'RadiologyController@actived');
        Route::resource('radiology', 'RadiologyController');

        Route::put('cure/activate/{id}', 'CureController@activate');
        Route::get('cure/category', 'CureController@category');
        Route::get('cure/category/actived', 'CureController@actived_category');
        Route::get('cure/actived', 'CureController@actived');
        Route::resource('cure', 'CureController');

        Route::put('bhp/activate/{id}', 'BhpController@activate');
        Route::get('bhp/category', 'BhpController@category');
        Route::get('bhp/category/actived', 'BhpController@actived_category');
        Route::get('bhp/actived', 'BhpController@actived');
        Route::resource('bhp', 'BhpController');
    });
});

