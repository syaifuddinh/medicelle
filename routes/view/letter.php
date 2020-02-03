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
    Route::name('pengantar_mrs.')->prefix('pengantar_mrs')
    ->group(function(){

        Route::get('/', function (){
            return view('letter/pengantar_mrs/index');
        })->name('index');
        Route::get('/create', function (){
            return view('letter/pengantar_mrs/create');
        })->name('create');
        Route::get('/edit/{id}', function ($id){
            return view('letter/pengantar_mrs/create')->withId($id);
        })->name('edit');
        Route::get('/{id}', function ($id){
            return view('letter/pengantar_mrs/show')->withId($id);
        })->name('show');

    });
    Route::name('rujukan_pasien.')->prefix('rujukan_pasien')
    ->group(function(){

        Route::get('/', function (){
            return view('letter/rujukan_pasien/index');
        })->name('index');
        Route::get('/create', function (){
            return view('letter/rujukan_pasien/create');
        })->name('create');
        Route::get('/edit/{id}', function ($id){
            return view('letter/rujukan_pasien/create')->withId($id);
        })->name('edit');
        Route::get('/{id}', function ($id){
            return view('letter/rujukan_pasien/show')->withId($id);
        })->name('show');

    });

    
Route::name('persetujuan_tindakan_medis.')->prefix('persetujuan_tindakan_medis')
->group(function(){

    Route::get('/', function (){
        return view('letter/persetujuan_tindakan_medis/index');
    })->name('index');
    Route::get('/create', function (){
        return view('letter/persetujuan_tindakan_medis/create');
    })->name('create');
    Route::get('/edit/{id}', function ($id){
        return view('letter/persetujuan_tindakan_medis/create')->withId($id);
    })->name('edit');
    Route::get('/{id}', function ($id){
        return view('letter/persetujuan_tindakan_medis/show')->withId($id);
    })->name('show');

});

});



