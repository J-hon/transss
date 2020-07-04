<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::group(['middleware' => ['web']], function() {

    Auth::routes();

    // Homepage
    Route::get('/', 'PagesController@index')->name('home');

    // Deposit
    Route::get('/deposit', 'RaveController@index')->name('deposit');

    Route::post('/pay', 'RaveController@initialize')->name('pay');
    Route::get('/rave/callback', 'RaveController@callback')->name('callback');

    Route::get('/transfer', 'TransferController@showTransferForm')->name('transfer');
    Route::post('/transfer', 'TransferController@transfer')->name('transfer');

    Route::get('/withdrawal', 'WithdrawalController@showWithdrawalForm')->name('withdrawal');
//    Route::post('/withdrawal', 'WithdrawalController@withdrawal')->name('withdraw');

});
