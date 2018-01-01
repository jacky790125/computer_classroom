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

//管理員才能看
Route::group(['middleware' => 'admin'],function() {
//系統管理
    Route::get('admin', function () {
        return view('admin.index');
    })->name('admin.index');

//帳號管理
    Route::get('admin/account', 'AccountController@index')->name('admin.account.index');
    Route::get('admin/account/create', 'AccountController@create')->name('admin.account.create');
    Route::get('admin/account/edit/{user}', 'AccountController@edit')->name('admin.account.edit');
    Route::post('admin/account/update/{user}', 'AccountController@update')->name('admin.account.update');
    Route::post('admin/account', 'AccountController@store')->name('admin.account.store');
    Route::get('admin/account/reset/{user}', 'AccountController@reset')->name('admin.account.reset');
    Route::get('admin/account/destroy/{user}', 'AccountController@destroy')->name('admin.account.destroy');
    Route::get('admin/account/storeMore', 'AccountController@storeMore')->name('admin.account.storeMore');
    Route::get('admin/account/download_csv', 'AccountController@download_csv')->name('admin.account.download_csv');

    //群組管理
    Route::post('admin/group','GroupController@store')->name('admin.group.store');
    Route::patch('admin/{group}','GroupController@update')->name('admin.group.update');
});

//註冊會員才能看
Route::group(['middleware' => 'auth'],function() {
    
});
