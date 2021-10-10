<?php

Route::name('report.')->prefix('report')
->group(function(){
    Route::get('/doctor_service', function (){
            return view('report/doctor_service/index');
    })->name('doctor_service');
    Route::get('/medical_bill', function (){
            return view('report/medical_bill/index');
    })->name('medical_bill');
    Route::get('/medical_payment', function (){
            return view('report/medical_payment/index');
    })->name('medical_payment');
    Route::get('/outgoing_stock', function (){
            return view('report/outgoing_stock/index');
    })->name('outgoing_stock');
    Route::get('/poly_report', function (){
            return view('report/poly_report/index');
    })->name('poly_report');

});
