<?php

Route::prefix('controller')
->name('controller.')
->group(function(){
    Route::prefix('letter')
    ->name('letter.')
    ->namespace('Letter')
    ->group(function(){
        Route::get('cuti_hamil/{id}/pdf', 'CutiHamilController@pdf')
        ->name('cuti_hamil.pdf');
        Route::resource('cuti_hamil', 'CutiHamilController');

        Route::get('keterangan_dokter/{id}/pdf', 'KeteranganDokterController@pdf')->name('keterangan_dokter.pdf');
        Route::resource('keterangan_dokter', 'KeteranganDokterController');

        Route::get('keterangan_sehat/{id}/pdf', 'KeteranganSehatController@pdf')->name('keterangan_sehat.pdf');
        Route::resource('keterangan_sehat', 'KeteranganSehatController');

        Route::get('layak_terbang/{id}/pdf', 'LayakTerbangController@pdf')->name('layak_terbang.pdf');
        Route::resource('layak_terbang', 'LayakTerbangController');

        Route::get('pengantar_mrs/{id}/pdf', 'PengantarMrsController@pdf')->name('pengantar_mrs.pdf');
        Route::resource('pengantar_mrs', 'PengantarMrsController');

        Route::get('rujukan_pasien/{id}/pdf', 'RujukanPasienController@pdf')->name('rujukan_pasien.pdf');
        Route::resource('rujukan_pasien', 'RujukanPasienController');

        Route::get('persetujuan_tindakan_medis/{id}/pdf', 'PersetujuanTindakanMedisController@pdf')->name('persetujuan_tindakan_medis.pdf');
        Route::resource('persetujuan_tindakan_medis', 'PersetujuanTindakanMedisController');
    });
});

