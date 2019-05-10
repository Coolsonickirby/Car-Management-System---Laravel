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

Route::get('/', 'ViewerController@FrontPage');
Route::get('/products', 'ViewerController@Products');
Route::get('/products/{id}', 'ViewerController@CarShowcase');
Route::get('/about', 'ViewerController@AboutPage');




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
Route::put('/admin/cars/edit/modify/{id}', 'AdminController@AdminCarPublishEdit');
Route::get('/admin/settings/changepassword','AdminController@showChangePasswordForm');
Route::post('/admin/settings/changepassword/new','AdminController@ChangePassword');
Route::get('/admin/settings/publicinfo', 'AdminController@FrontPageInfoEditor');
Route::post('/admin/settings/publicinfo/submit', 'AdminController@FrontPageInfoSubmit');