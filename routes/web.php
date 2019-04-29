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

Route::get('/', function () {
    return view('home');
});

Route::get('/randomvin', function () {
    echo file_get_contents("http://randomvin.com/getvin.php?type=real");
});

Auth::routes();

Route::get('/admin', 'AdminController@AdminHome');
Route::get('/admin/cars', 'AdminController@AdminCars');
