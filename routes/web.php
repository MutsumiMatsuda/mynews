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
Auth::routes();


/*-------------------------------------------------------------------------
  1) User 認証不要
---------------------------------------------------------------------------*/
Route::get('/', 'NewsController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/info', 'HomeController@php_info')->name('info');
Route::get('profile/{id}/show', 'ProfileController@show');
Route::get('news/{id}/show', 'NewsController@show');

/*-------------------------------------------------------------------------
  2) User ログイン後
---------------------------------------------------------------------------*/
Route::group(['prefix' => 'users', 'middleware' => 'auth:user'], function () {
    Route::get('news/create', 'Users\NewsController@add');
    Route::post('news/create', 'Users\NewsController@create');
    Route::get('news', 'Users\NewsController@index');
    Route::get('news/edit', 'Users\NewsController@edit');
    Route::post('news/edit', 'Users\NewsController@update');
    Route::get('news/delete', 'Users\NewsController@delete');
    // Route::get('profile/create', 'Users\ProfileController@add');
    // Route::post('profile/create', 'Users\ProfileController@create');
    Route::get('profile/edit', 'Users\ProfileController@edit');
    Route::post('profile/edit', 'Users\ProfileController@update');

});

/*-------------------------------------------------------------------------
  3) Admin 認証不要
---------------------------------------------------------------------------*/
Route::group(['prefix' => 'admin'], function() {
    //Route::get('/',         function () { return redirect('/admin/home'); });
    Route::get('login',     'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login',    'Admin\LoginController@login');
});

/*-------------------------------------------------------------------------
  4) Admin ログイン後
---------------------------------------------------------------------------*/
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::get('/', 'Admin\AdminController@index');
    Route::post('logout',   'Admin\LoginController@logout')->name('admin.logout');
    Route::get('home',      'Admin\HomeController@index')->name('admin.home');
});
