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

Route::get('/manage', function () {
    return redirect('manage/login');
});

Route::group(['prefix' => 'manage'], function () {
    //login bypass for the below listed controllers
    Route::get('login', 'LoginController@index');
});

//initial route for dashboard to load layout master
Route::middleware('ManageAuth')->get('manage/dashboard', function () {
    return view('layouts.managemaster');
});

Route::any('manage/dologin', 'LoginController@Dologin');
Route::any('manage/forgotpassword', 'LoginController@Forgotpassword');
Route::any('manage/resetpassword', 'LoginController@Resetpassword');
Route::any('manage/doresetpassword', 'LoginController@Doresetpassword');
Route::get('manage/logout', 'LoginController@Logout');

Route::get('/', function () {
    return view('welcome');
});