<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(
    [
        'middleware' => ['web','auth']
    ], function(){
		require(base_path('routes/view/common.php'));
        require(base_path('routes/controller/user.php'));

        Route::namespace('Datatable')->prefix('datatable')->group(function(){
            require(base_path('routes/datatable/user.php'));
        });
});
Route::get('/logout', 'Auth\LoginController@logout');

Auth::routes(['register' => false]);