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

Route::group(['prefix' => 'login'], function() {
    Route::get('google', 'Auth\LoginController@redirectToGoogle');
    Route::get('google/callback', 'Auth\LoginController@handleGoogleCallback');
    Route::get('twitter', 'Auth\LoginController@redirectToTwitter');
    Route::get('twitter/callback', 'Auth\LoginController@handleTwitterCallback');
});

Auth::routes();

Route::get('/home', 'TrainingController@add')->name('home');
Route::post('/home', 'TrainingController@add')->name('home');
Route::post('/training/home/create', 'TrainingController@create');
Route::post('/training/home/edit', 'TrainingController@edit');
Route::post('/training/home/delete', 'TrainingController@delete');

// Route::post('/home', 'HomeController@index')->name('home');

// Route::group(['prefix' => 'calendar'], function() {
    Route::get('/home?y_m_d=2020-03', 'CalendarController@lt');
// });