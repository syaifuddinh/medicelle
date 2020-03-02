<?php

Route::prefix('controller')->name('controller.')->group(function(){
    Route::prefix('master')->namespace('Master')->group(function(){
        Route::get('province', 'CityController@province');
        Route::get('city', 'CityController@index');
        Route::get('district', 'DistrictController@index');
        Route::get('village', 'VillageController@index');

        Route::put('specialization/activate/{specialization}', 'SpecializationController@activate');
        Route::get('specialization/medical_record_roles', 'SpecializationController@medical_record_roles');
        Route::resource('specialization', 'SpecializationController');

        Route::put('polyclinic/activate/{polyclinic}', 'PolyclinicController@activate');
        Route::resource('polyclinic', 'PolyclinicController');

        Route::put('discount/activate/{discount}', 'DiscountController@activate');
        Route::resource('discount', 'DiscountController');

        Route::put('piece/activate/{piece}', 'PieceController@activate');
        Route::get('piece/actived', 'PieceController@actived');
        Route::resource('piece', 'PieceController');


        Route::get('lokasi/gudang_farmasi', 'LokasiController@gudang_farmasi');
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

        Route::put('medical_item/activate/{id}', 'MedicalItemController@activate');
        Route::get('medical_item/category', 'MedicalItemController@category');
        Route::get('medical_item/category/actived', 'MedicalItemController@actived_category');
        Route::get('medical_item/actived', 'MedicalItemController@actived');
        Route::resource('medical_item', 'MedicalItemController');


        Route::post('obat/category', 'ObatController@store_jenis_administrasi');
        Route::post('obat/classification', 'ObatController@store_classification');
        Route::post('obat/subclassification', 'ObatController@store_subclassification');
        Route::post('obat/generic', 'ObatController@store_generic');

        Route::get('obat/category/actived', 'ObatController@actived_category');
        Route::get('obat/classification/actived', 'ObatController@actived_classification');
        Route::get('obat/subclassification/actived', 'ObatController@actived_subclassification');
        Route::get('obat/generic/actived', 'ObatController@actived_generic');

        Route::put('obat/activate/{id}', 'ObatController@activate');
        Route::get('obat/category', 'ObatController@category');
        Route::get('obat/actived', 'ObatController@actived');
        Route::resource('obat', 'ObatController');

        Route::put('bhp/activate/{id}', 'BhpController@activate');
        Route::get('bhp/category', 'BhpController@category');
        Route::get('bhp/category/actived', 'BhpController@actived_category');
        Route::get('bhp/actived', 'BhpController@actived');
        Route::resource('bhp', 'BhpController');
    });
});

