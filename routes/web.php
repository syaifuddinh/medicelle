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
        require(base_path('routes/view/master.php'));
        require(base_path('routes/view/registration.php'));
        require(base_path('routes/view/cashier.php'));
        require(base_path('routes/view/polyclinic.php'));
        require(base_path('routes/view/letter.php'));
        require(base_path('routes/view/pharmacy.php'));

        require(base_path('routes/controller/user.php'));
        require(base_path('routes/controller/master.php'));
        require(base_path('routes/controller/registration.php'));
        require(base_path('routes/controller/cashier.php'));
        require(base_path('routes/controller/letter.php'));
        require(base_path('routes/controller/pharmacy.php'));

        Route::namespace('Datatable')
        ->prefix('datatable')
        ->middleware(['compareDate'])
        ->group(function(){
            require(base_path('routes/datatable/user.php'));
            require(base_path('routes/datatable/master.php'));
            require(base_path('routes/datatable/registration.php'));
            require(base_path('routes/datatable/cashier.php'));
            require(base_path('routes/datatable/letter.php'));
            require(base_path('routes/datatable/pharmacy.php'));
        });
});
Route::get('/logout', 'Auth\LoginController@logout');

Auth::routes(['register' => false]);