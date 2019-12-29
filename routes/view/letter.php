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

    Route::name('keterangan_dokter.')->prefix('keterangan_dokter')
    ->group(function(){

        Route::get('/', function (){
            return view('letter/keterangan_dokter/index');
        })->name('index');
        Route::get('/create', function (){
            return view('letter/keterangan_dokter/create');
        })->name('create');
        Route::get('/edit/{id}', function ($id){
            return view('letter/keterangan_dokter/create')->withId($id);
        })->name('edit');
        Route::get('/{id}', function ($id){
            return view('letter/keterangan_dokter/show')->withId($id);
        })->name('show');
    });

    Route::name('keterangan_sehat.')->prefix('keterangan_sehat')
    ->group(function(){

        Route::get('/', function (){
            return view('letter/keterangan_sehat/index');
        })->name('index');
        Route::get('/create', function (){
            return view('letter/keterangan_sehat/create');
        })->name('create');
        Route::get('/edit/{id}', function ($id){
            return view('letter/keterangan_sehat/create')->withId($id);
        })->name('edit');
        Route::get('/{id}', function ($id){
            return view('letter/keterangan_sehat/show')->withId($id);
        })->name('show');

    });


    Route::name('layak_terbang.')->prefix('layak_terbang')
    ->group(function(){

        Route::get('/', function (){
            return view('letter/layak_terbang/index');
        })->name('index');
        Route::get('/create', function (){
            return view('letter/layak_terbang/create');
        })->name('create');
        Route::get('/edit/{id}', function ($id){
            return view('letter/layak_terbang/create')->withId($id);
        })->name('edit');
        Route::get('/{id}', function ($id){
            return view('letter/layak_terbang/show')->withId($id);
        })->name('show');

    });

});
