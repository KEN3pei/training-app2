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


Route::get('/admin/home', 'AdminHomeController@index')->name('admin_auth.home');

Route::get('/admin/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin_auth.login');
Route::post('/admin/login', 'AuthAdmin\LoginController@login')->name('admin_auth.login');
Route::post('/admin/logout', 'AuthAdmin\LoginController@logout')->name('admin_auth.logout');
Route::get('/admin/register', 'AuthAdmin\RegisterController@showRegistrationForm')->name('admin_auth.register');
Route::post('/admin/register', 'AuthAdmin\RegisterController@register')->name('admin_auth.register');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
