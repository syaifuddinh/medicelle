<?php

Route::name('report.')->prefix('report')
->group(function(){
    Route::get('/medical_bill', function (){
            return view('report/medical_bill/index');
    })->name('medical_bill');
});
