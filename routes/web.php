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

Route::group(['middleware' => ['auth']], function () {

    // Dashboard route...
    Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard');

    // Deposit routes...
    Route::get('/deposit', 'RaveController@index')->name('deposit');
    Route::post('rave/pay', 'RaveController@initialize')->name('pay');

    // Webhook route
    Route::post('/payment/webhook', 'FlutterwaveWebhookController@receive');

    // Transfer routes...
    Route::get('/transfer', 'TransferController@showTransferForm')->name('transfer');
    Route::post('/transfer', 'TransferController@transfer')->name('transfer');

    // Withdrawal routes...
    Route::get('/withdrawal', 'WithdrawalController@showWithdrawalForm')->name('withdrawal');
    Route::post('/withdrawal', 'WithdrawalController@withdrawal')->name('withdraw');

    // Transaction routes...
    Route::get('/transactions', 'TransactionController@transaction')->name('transactions');
});

Route::group(['middleware' => ['web']], function() {

    // Homepage route...
    Route::get('/', 'PagesController@index')->name('home');

    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

    // Confirm Password (added in v6.2)
    Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

    // Email Verification Routes...
    Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify'); // v6.x
    /* Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify'); // v5.x */
    Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

});
