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

Route::get('/callback', 'HomeController@index');
Route::get('/success', 'HomeController@paymentSuccess')->name('success');
Route::get('/error', 'HomeController@paymentError')->name('error');
Route::post('/submitPayment', 'HomeController@submitPay')->name('submitPayment');