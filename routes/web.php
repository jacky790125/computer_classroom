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
    Route::get('admin/task/view/{select}/{for}/{task_id}', 'TaskController@view')->name('admin.task.view');
    Route::get('admin/task/view_one/{student_task}', 'TaskController@view_one')->name('admin.task.view_one');
    Route::get('admin/task/add_student_task/{task_id}/{user_id}', 'TaskController@add_student_task')->name('add_student_task');
    Route::post('admin/task/stud_store', 'TaskController@stud_store')->name('admin.task.stud_store');


    //公告系統
    Route::get('post/create', 'PostController@create')->name('post.create');
    Route::post('post/store', 'PostController@store')->name('post.store');
    Route::get('post/{post}/edit', 'PostController@edit')->name('post.edit');
    Route::patch('post/{post}/update', 'PostController@update')->name('post.update');
    Route::get('post/{post}/destroy', 'PostController@destroy')->name('post.destroy');

    //打字管理
    Route::get('student_type/admin/index', 'StudentTypeController@admin_index')->name('student_type.admin_index');
    Route::post('student_type/admin/store', 'StudentTypeController@admin_store')->name('student_type.admin_store');
});

//註冊會員才能看
Route::group(['middleware' => 'auth'],function() {
    Route::post('personal_info_update/{user}','HomeController@personal_info_update')->name('personal_info.update');
    Route::get('student_task/{student_task}/upload', 'StudentTaskController@upload')->name('student_task.upload');
    Route::post('student_task/{student_task}/store', 'StudentTaskController@store')->name('student_task.store');
    Route::get('student_task/{student_task}/view', 'StudentTaskController@view')->name('student_task.view');

    //線上打字
    Route::get('student_type/typing', 'StudentTypeController@typing')->name('student_type.typing');
    Route::post('student_type/store_typing', 'StudentTypeController@store_typing')->name('student_type.store.typing');
});

//公開的公告
Route::get('post/index', 'PostController@index')->name('post.index');
Route::post('post/view', 'PostController@view')->name('post.view');

//公開的學生作業
Route::get('student_task/index', 'StudentTaskController@index')->name('student_task.index');
Route::get('student_task/select', 'StudentTaskController@open')->name('student_task.select');
Route::any('student_task/open', 'StudentTaskController@open')->name('student_task.open');
Route::post('student_task/likes', 'StudentTaskController@likes')->name('student_task.likes');
Route::post('student_task/views', 'StudentTaskController@views')->name('student_task.views');

//打字
Route::get('student_type/index', 'StudentTypeController@index')->name('student_type.index');

//取得頭像
Route::get('avatars/{user}', 'HomeController@getAvatar');

//取得檔案
Route::get('file/{student_task}', 'StudentTaskController@getFile');

//下載檔案
Route::get('download_file/{student_task}', 'StudentTaskController@downloadFile')->name('download_student_task');