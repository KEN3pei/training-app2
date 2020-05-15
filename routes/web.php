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
use App\Models\User;

Route::get('/', function () {
    return redirect('login');
});
Route::get('/admin', function () {
    return redirect('/admin/login');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('home', 'AdminHomeController@index')->name('admin_auth.home');
    Route::post('delete', 'AdminHomeController@delete');
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

// Auth::routes();

Route::group(['prefix' => 'home'], function() {
    Route::get('/', 'TrainingController@add')->name('home');
    Route::post('/', 'TrainingController@add')->name('home');
    Route::post('/create', 'TrainingController@create');
    Route::post('/edit', 'TrainingController@edit');
    Route::post('/delete', 'TrainingController@delete');
    Route::post('/search', 'TrainingController@search');
});

    Route::get('/profile', 'ProfileController@profile');
    Route::post('/profile', 'ProfileController@profile');
    Route::get('/profile/delete', 'ProfileController@out');
    Route::post('/profile/delete', 'ProfileController@ondeletefrag');


Route::group(['prefix' => 'training'], function() {
    Route::get('/comment', 'CommentController@index');
    Route::post('/comment', 'CommentController@index');
    Route::get('/comment/create', 'CommentController@create');
    Route::post('/comment/create', 'CommentController@create');
    Route::get('/comment/delete', 'CommentController@delete');
    Route::post('/comment/delete', 'CommentController@delete');
    
    Route::get('/commentlist', 'CommentController@add');
    Route::post('/commentlist', 'CommentController@add');
});

Route::get('/favorite/attach', 'FavoriteController@attach');
Route::post('/favorite/attach', 'FavoriteController@attach');
Route::get('/favorite/detach', 'FavoriteController@detach');
Route::post('/favorite/detach', 'FavoriteController@detach');


Auth::routes();

Route::get('/users', function () {
    return User::all();
    // return ['Ken','Mike','John','Lisa'];
});


