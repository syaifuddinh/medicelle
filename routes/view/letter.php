<?php

Route::name('surat.')->prefix('surat')
->group(function(){

    Route::name('cuti_hamil.')->prefix('cuti_hamil')
    ->group(function(){

        Route::get('/', function (){
            return view('letter/cuti_hamil/index');
        })->name('index');
        Route::get('/create', function (){
            return view('letter/cuti_hamil/create');
        })->name('create');
        Route::get('/edit/{id}', function ($id){
            return view('letter/cuti_hamil/create')->withId($id);
        })->name('edit');
        Route::get('/{id}', function ($id){
            return view('letter/cuti_hamil/show')->withId($id);
        })->name('show');
});

});
