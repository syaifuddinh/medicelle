<?php

Route::prefix('letter')->group(function(){
    Route::get('cuti_hamil', 'LetterApiController@cuti_hamil');
    Route::get('keterangan_dokter', 'LetterApiController@keterangan_dokter');
    Route::get('keterangan_sehat', 'LetterApiController@keterangan_sehat');
    Route::get('layak_terbang', 'LetterApiController@layak_terbang');
    Route::get('pengantar_mrs', 'LetterApiController@pengantar_mrs');
    Route::get('rujukan_pasien', 'LetterApiController@rujukan_pasien');
    Route::get('persetujuan_tindakan_medis', 'LetterApiController@persetujuan_tindakan_medis');
    
});

