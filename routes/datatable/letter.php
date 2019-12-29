<?php

Route::prefix('letter')->group(function(){
    Route::get('cuti_hamil', 'LetterApiController@cuti_hamil');
    Route::get('keterangan_dokter', 'LetterApiController@keterangan_dokter');
    Route::get('keterangan_sehat', 'LetterApiController@keterangan_sehat');
    Route::get('layak_terbang', 'LetterApiController@layak_terbang');
    
});

