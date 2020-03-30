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
    return redirect('login');
});
Route::get('/admin', function () {
    return redirect('/admin/login');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('home', 'AdminHomeController@index')->name('admin_auth.home');
    Route::get('login', 'AuthAdmin\LoginController@showLoginForm')->name('admin_auth.login');
    Route::post('login', 'AuthAdmin\LoginController@login')->name('admin_auth.login');
    Route::post('logout', 'AuthAdmin\LoginController@logout')->name('admin_auth.logout');
    Route::get('register', 'AuthAdmin\RegisterController@showRegistrationForm')->name('admin_auth.register');
    Route::post('register', 'AuthAdmin\RegisterController@register')->name('admin_auth.register');
});

Route::get('login/google', 'Auth\LoginController@redirectToGoogle');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');

Route::get('login/twitter', 'Auth\LoginController@redirectToTwitter');
Route::get('login/twitter/callback', 'Auth\LoginController@handleTwitterCallback');

Auth::routes();

Route::get('/home', 'TrainingController@add')->name('home');
Route::post('/home', 'TrainingController@add')->name('home');
Route::post('/training/home', 'TrainingController@create');
// Route::post('/home', 'HomeController@index')->name('home');
