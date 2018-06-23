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



Route::any('/verifyemail/{token}/{email}', 'ApiloginController@Verifyemail');

// To get the email of the verification.
Route::get('/email', function () {
	$data = array('name' => 'Jigs','email' => 'viranijignesh91@gmail.com', 'code' => str_random(25));
    return view('email.account_verification', $data);
});

Route::get('/', function () {
    return view('welcome');
});