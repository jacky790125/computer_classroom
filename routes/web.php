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
    return view('welcome');
})->name('/');


Auth::routes();

//Route::get('/', 'HomeController@index')->name('index');
Route::get('/index', 'HomeController@index')->name('index');


Route::group(['middleware' => 'admin'],function(){
    Route::get('/admin', 'HomeController@admin')->name('admin');
});

# 登入/登出
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//系統管理
Route::get('setting', function () {
    return view('settings.index');
})->name('setting.index');

//帳號管理
Route::get('SetAccount', 'SetAccountController@index')->name('SetAccount');
