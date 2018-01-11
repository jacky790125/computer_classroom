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
    Route::get('admin/account/group', 'AccountController@group_index')->name('admin.account.group');
    Route::get('admin/account/create', 'AccountController@create')->name('admin.account.create');
    Route::get('admin/account/edit/{user}', 'AccountController@edit')->name('admin.account.edit');
    Route::post('admin/account/update/{user}', 'AccountController@update')->name('admin.account.update');
    Route::post('admin/account', 'AccountController@store')->name('admin.account.store');
    Route::get('admin/account/reset/{user}', 'AccountController@reset')->name('admin.account.reset');
    Route::get('admin/account/destroy/{user}', 'AccountController@destroy')->name('admin.account.destroy');
    Route::post('admin/account/storeMore', 'AccountController@storeMore')->name('admin.account.storeMore');
    Route::get('admin/account/download_csv', 'AccountController@download_csv')->name('admin.account.download_csv');

    //群組管理
    Route::post('admin/group','GroupController@store')->name('admin.group.store');
    Route::patch('admin/{group}','GroupController@update')->name('admin.group.update');

    //訊息管理
    Route::get('admin/message', 'MessageController@index')->name('admin.message.index');

    //公告管理
    Route::get('admin/post', 'PostController@admin_post')->name('admin.post.index');
    Route::get('admin/post/{post}/destroy', 'PostController@admin_destroy')->name('admin.post.destroy');

    //作業管理
    Route::get('admin/task', 'TaskController@index')->name('admin.task.index');
    Route::post('admin/task', 'TaskController@store')->name('admin.task.store');
    Route::get('admin/task/destroy{task}', 'TaskController@destroy')->name('admin.task.destroy');

    //公告系統
    Route::get('post/create', 'PostController@create')->name('post.create');
    Route::post('post/store', 'PostController@store')->name('post.store');
    Route::get('post/{post}/edit', 'PostController@edit')->name('post.edit');
    Route::patch('post/{post}/update', 'PostController@update')->name('post.update');
    Route::get('post/{post}/destroy', 'PostController@destroy')->name('post.destroy');
});

//註冊會員才能看
Route::group(['middleware' => 'auth'],function() {
    Route::post('personal_info_update/{user}','HomeController@personal_info_update')->name('personal_info.update');
    Route::get('student_task/{student_task}/upload', 'StudentTaskController@upload')->name('student_task.upload');
    Route::post('student_task/{student_task}/store', 'StudentTaskController@store')->name('student_task.store');
});

//公開的公告
Route::get('post/index', 'PostController@index')->name('post.index');

//公開的學生作業
Route::get('student_task/index', 'StudentTaskController@index')->name('student_task.index');


//取得頭像
Route::get('avatars/{user}', 'HomeController@getAvatar');
