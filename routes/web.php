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


//Public View
Route::get('/', 'ViewerController@FrontPage');
Route::get('/products', 'ViewerController@Products');
Route::get('/products/{id}', 'ViewerController@CarShowcase');
Route::get('/about', 'ViewerController@AboutPage');



//Random Vin Function
Route::get('/randomvin', function () {
    echo file_get_contents("http://randomvin.com/getvin.php?type=real");
});

//Auth Routes for Admin
Auth::routes();

//Admin Home
Route::get('/admin', 'AdminController@AdminHome');

//Admin Car
Route::get('/admin/cars', 'AdminController@AdminCars');
Route::get('/admin/cars/add', 'AdminController@AdminCarAdder');
Route::post('/admin/cars/add/new', 'AdminController@AdminNewCar');
Route::get('/admin/cars/remove/{id}', 'AdminController@AdminCarRemover');
Route::get('/admin/cars/edit/{id}', 'AdminController@AdminCarEditor');
Route::post('/admin/cars/edit/modify/{id}', 'AdminController@AdminCarPublishEdit');
Route::get('/admin/cars/sell/{id}', 'AdminController@SellCar');
Route::post('/admin/cars/sell/invoice/{id}', 'AdminController@SellCarPDF');
Route::get('/admin/cars/random', 'AdminController@RandomCars');

//PDF
Route::get('/admin/pdf', 'AdminController@pdf');
Route::get('/admin/pdf1', 'AdminController@pdf1');


//Admin Settings
Route::get('/admin/settings/changepassword','AdminController@showChangePasswordForm');
Route::post('/admin/settings/changepassword/new','AdminController@ChangePassword');
Route::get('/admin/settings/publicinfo', 'AdminController@FrontPageInfoEditor');
Route::post('/admin/settings/publicinfo/submit', 'AdminController@FrontPageInfoSubmit');
Route::get( '/admin/settings/createuser', 'AdminController@CreateUser');
Route::post('/admin/settings/createuser/new', 'AdminController@CreateUserNew');
Route::get('/admin/settings/viewusers', 'AdminController@ViewUsers');
Route::get('/admin/settings/removeuser/{id}', 'AdminController@RemoveUser');
Route::get('/admin/settings/invoices', 'AdminController@InvoicesList');
Route::get('/admin/settings/invoices/view/{id}', 'AdminController@InvoiceView');