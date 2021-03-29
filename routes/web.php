<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::get('/login', 'LoginController@index');
Route::post('login', [ 'as' => 'login', 'uses' => 'LoginController@index']);
Route::post('/login/check', 'LoginController@checklogin');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout' , 'LoginController@logout');

    //CUSTOMER ROUTE
    Route::get('/customer' , 'CustomerController@index');
    Route::get('/customer/get-data' , 'CustomerController@get_data');
    Route::get('/customer/form' , 'CustomerController@form');
    Route::get('/customer/get-location' , 'CustomerController@get_location');
    Route::get('/customer/delete/{id}' , 'CustomerController@delete');
    Route::post('/customer/save', 'CustomerController@save');
});

