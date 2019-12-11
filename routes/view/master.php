<?php

Route::name('specialization.')->prefix('specialization')
->group(function(){

    Route::get('/', function (){
        return view('master/specialization/index');
    })->name('index');
    Route::get('/create', function (){
        return view('master/specialization/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('master/specialization/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('master/specialization/show')->withId($id);
    })->name('show');
});

Route::name('polyclinic.')->prefix('polyclinic')
->group(function(){

    Route::get('/', function (){
        return view('master/polyclinic/index');
    })->name('index');
    Route::get('/create', function (){
        return view('master/polyclinic/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('master/polyclinic/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('master/polyclinic/show')->withId($id);
    })->name('show');
});

Route::name('piece.')->prefix('piece')
->group(function(){

    Route::get('/', function (){
        return view('master/piece/index');
    })->name('index');
    Route::get('/create', function (){
        return view('master/piece/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('master/piece/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('master/piece/show')->withId($id);
    })->name('show');
});

Route::name('discount.')->prefix('discount')
->group(function(){

    Route::get('/', function (){
        return view('master/discount/index');
    })->name('index');
    Route::get('/create', function (){
        return view('master/discount/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('master/discount/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('master/discount/show')->withId($id);
    })->name('show');
});

Route::name('doctor.')->prefix('doctor')
->group(function(){

    Route::get('/', function (){
        return view('master/doctor/index');
    })->name('index');
    Route::get('/create', function (){
        return view('master/doctor/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('master/doctor/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('master/doctor/show')->withId($id);
    })->name('show');
});

Route::name('supplier.')->prefix('supplier')
->group(function(){

    Route::get('/', function (){
        return view('master/supplier/index');
    })->name('index');
    Route::get('/create', function (){
        return view('master/supplier/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('master/supplier/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('master/supplier/show')->withId($id);
    })->name('show');
});


Route::name('agency.')->prefix('agency')
->group(function(){

    Route::get('/', function (){
        return view('master/agency/index');
    })->name('index');
    Route::get('/create', function (){
        return view('master/agency/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('master/agency/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('master/agency/show')->withId($id);
    })->name('show');
});

Route::name('nurse.')->prefix('nurse')
->group(function(){

    Route::get('/', function (){
        return view('master/nurse/index');
    })->name('index');
    Route::get('/create', function (){
        return view('master/nurse/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('master/nurse/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('master/nurse/show')->withId($id);
    })->name('show');
});

Route::name('nurse_helper.')->prefix('nurse_helper')
->group(function(){

    Route::get('/', function (){
        return view('master/nurse_helper/index');
    })->name('index');
    Route::get('/create', function (){
        return view('master/nurse_helper/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('master/nurse_helper/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('master/nurse_helper/show')->withId($id);
    })->name('show');
});

Route::name('supplier.')->prefix('supplier')
->group(function(){

    Route::get('/', function (){
        return view('master/supplier/index');
    })->name('index');
    Route::get('/create', function (){
        return view('master/supplier/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('master/supplier/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('master/supplier/show')->withId($id);
    })->name('show');
});

Route::name('employee.')->prefix('employee')
->group(function(){

    Route::get('/', function (){
        return view('master/employee/index');
    })->name('index');
    Route::get('/create', function (){
        return view('master/employee/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('master/employee/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('master/employee/show')->withId($id);
    })->name('show');
});

Route::name('patient.')->prefix('patient')
->group(function(){

    Route::get('/', function (){
        return view('master/patient/index');
    })->name('index');
    Route::get('/create', function (){
        return view('master/patient/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('master/patient/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('master/patient/show')->withId($id);
    })->name('show');
    Route::get('/{id}/medical_record', function ($id){
        return view('registration/medical_record/index')->withId($id);
    })->name('show');
});

Route::name('disease.')->prefix('disease')
->group(function(){

    Route::get('/', function (){
        return view('master/disease/index');
    })->name('index');
    Route::get('/create', function (){
        return view('master/disease/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('master/disease/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('master/disease/show')->withId($id);
    })->name('show');
});

Route::name('disease_category.')->prefix('disease_category')
->group(function(){

    Route::get('/', function (){
        return view('master/disease_category/index');
    })->name('index');
    Route::get('/create', function (){
        return view('master/disease_category/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('master/disease_category/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('master/disease_category/show')->withId($id);
    })->name('show');
});

Route::name('administration.')->prefix('administration')
->group(function(){

    Route::get('/', function (){
        return view('master/administration/index');
    })->name('index');
    Route::get('/create', function (){
        return view('master/administration/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('master/administration/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('master/administration/show')->withId($id);
    })->name('show');
});

Route::name('radiology.')->prefix('radiology')
->group(function(){

    Route::get('/', function (){
        return view('master/radiology/index');
    })->name('index');
    Route::get('/create', function (){
        return view('master/radiology/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('master/radiology/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('master/radiology/show')->withId($id);
    })->name('show');
});

Route::name('pathology.')->prefix('pathology')
->group(function(){

    Route::get('/', function (){
        return view('master/pathology/index');
    })->name('index');
    Route::get('/create', function (){
        return view('master/pathology/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('master/pathology/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('master/pathology/show')->withId($id);
    })->name('show');
});

Route::name('laboratory.')->prefix('laboratory')
->group(function(){

    Route::get('/', function (){
        return view('master/laboratory/index');
    })->name('index');
    Route::get('/create', function (){
        return view('master/laboratory/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('master/laboratory/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('master/laboratory/show')->withId($id);
    })->name('show');
});

Route::name('pharmacy.')->prefix('pharmacy')
->group(function(){

    Route::get('/', function (){
        return view('master/pharmacy/index');
    })->name('index');
    Route::get('/create', function (){
        return view('master/pharmacy/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('master/pharmacy/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('master/pharmacy/show')->withId($id);
    })->name('show');
});