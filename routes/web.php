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

Route::get('/', 'AdminController@AdminHome');
Route::get('/home', function(){
    return redirect('/admin');
});

Route::get('/randomvin', function () {
    echo file_get_contents("http://randomvin.com/getvin.php?type=real");
});

Auth::routes();

Route::get('/admin', 'AdminController@AdminHome');
Route::get('/admin/cars', 'AdminController@AdminCars');
Route::get('/admin/cars/add', 'AdminController@AdminCarAdder');
Route::post('/admin/cars/add/new', 'AdminController@AdminNewCar');
Route::get('/admin/cars/remove/{id}', 'AdminController@AdminCarRemover');
Route::get('/admin/cars/edit/{id}', 'AdminController@AdminCarEditor');
Route::post('/admin/cars/edit/modify/{id}', 'AdminController@AdminCarPublishEdit');
Route::get('/admin/settings/changepassword','AdminController@showChangePasswordForm');
Route::post('/admin/settings/changepassword/new','AdminController@ChangePassword');
