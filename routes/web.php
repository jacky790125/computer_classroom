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
Route::any('/index', 'HomeController@index')->name('index');


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
    Route::any('admin/account/index', 'AccountController@index')->name('admin.account.index');
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
    Route::post('admin/message/store', 'MessageController@store')->name('admin.message.store');

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
    Route::get('admin/task/stud_remove/{student_task}', 'TaskController@stud_remove')->name('admin.task.stud_remove');


    //測驗管理
    Route::any('admin/course', 'TestController@index')->name('admin.test.course_index');
    Route::post('admin/course/store','TestController@course_store')->name('admin.test.course_store');
    Route::patch('admin/course/{course}/update','TestController@course_update')->name('admin.test.course_update');
    Route::get('admin/course/{course}/destroy', 'TestController@course_delete')->name('admin.test.course_delete');

    Route::post('admin/question/store','TestController@question_store')->name('admin.test.question_store');
    Route::any('admin/question', 'TestController@question_index')->name('admin.test.question');
    Route::post('admin/question/update/{course_question}','TestController@question_update')->name('admin.test.question_update');
    Route::get('admin/question/{img}/{id}/delete', 'TestController@question_delete_img')->name('admin.test.question_delete_img');


    //公告系統
    Route::get('post/create', 'PostController@create')->name('post.create');
    Route::post('post/store', 'PostController@store')->name('post.store');
    Route::get('post/{post}/edit', 'PostController@edit')->name('post.edit');
    Route::patch('post/{post}/update', 'PostController@update')->name('post.update');
    Route::get('post/{post}/destroy', 'PostController@destroy')->name('post.destroy');

    //打字管理
    Route::get('student_type/admin/index', 'StudentTypeController@admin_index')->name('student_type.admin_index');
    Route::post('student_type/admin/store', 'StudentTypeController@admin_store')->name('student_type.admin_store');
    Route::get('student_type/admin/delete/{stud_type_article}', 'StudentTypeController@admin_delete')->name('student_type.admin_delete');

    //連結管理
    Route::get('link/admin/index','LinkController@index')->name('link.admin_index');
    Route::post('link/admin/store','LinkController@store')->name('link.admin_store');
    Route::post('link/admin/update/{link}','LinkController@update')->name('link.admin_update');
    Route::get('link/admin/destroy/{link}','LinkController@destroy')->name('link.admin_del');

    //課程管理
    Route::get('book/admin/index','BookController@index')->name('book.admin_index');
    Route::post('book/admin/store','BookController@store')->name('book.admin_store');
    Route::post('book/admin/update/{book}','BookController@update')->name('book.admin_update');
    Route::get('book/admin/destroy/{book}','BookController@destroy')->name('book.admin_del');

    Route::get('discuss/{discuss}/admin_destroy', 'DiscussController@admin_destroy')->name('discuss.admin_destroy');
    Route::get('discuss/{discuss}/admin_reback', 'DiscussController@admin_reback')->name('discuss.admin_reback');
});

//註冊會員才能看
Route::group(['middleware' => 'auth'],function() {
    Route::post('personal_info_update/{user}','HomeController@personal_info_update')->name('personal_info.update');
    Route::get('student_task/{student_task}/upload', 'StudentTaskController@upload')->name('student_task.upload');
    Route::post('student_task/{student_task}/store', 'StudentTaskController@store')->name('student_task.store');
    Route::get('student_task/{student_task}/view', 'StudentTaskController@view')->name('student_task.view');
    Route::get('student_task/{student_task}/for_money', 'StudentTaskController@for_money')->name('student_task.for_money');

    //線上打字
    Route::get('student_type/typing/{article}', 'StudentTypeController@typing')->name('student_type.typing');
    Route::post('student_type/store_typing', 'StudentTypeController@store_typing')->name('student_type.store.typing');
    Route::get('student_money/view', 'HomeController@view_stud_money')->name('view_stud_money');

    //訊息盒
    Route::get('stud_message/index', 'StudMessageController@index')->name('stud_message.index');
    Route::post('stud_message/store', 'StudMessageController@store')->name('stud_message.store');
    Route::get('stud_message/read/{stud_message}', 'StudMessageController@read')->name('stud_message.read');
    Route::get('stud_message/close', 'StudMessageController@close')->name('stud_message.close');
    Route::get('stud_message/delete/{stud_message}', 'StudMessageController@destroy')->name('stud_message.destroy');

    //兌換遊戲
    Route::get('game/{id}','GameController@html5_game')->name('game.html5_game');

    //討論區
    Route::get('discuss/show/{discuss}', 'DiscussController@show')->name('discuss.show');
    Route::get('discuss/create', 'DiscussController@create')->name('discuss.create');
    Route::post('discuss/store', 'DiscussController@store')->name('discuss.store');


    Route::get('discuss/{discuss}/destroy', 'DiscussController@destroy')->name('discuss.destroy');
    Route::get('discuss/{discuss}/say_bad', 'DiscussController@say_bad')->name('discuss.say_bad');
    Route::post('discuss/reply_store', 'DiscussController@reply_store')->name('discuss.reply_store');
    Route::get('discuss/{discuss}/reply_destroy', 'DiscussController@reply_destroy')->name('discuss.reply_destroy');
    Route::get('discuss/{discuss}/reply_say_bad', 'DiscussController@reply_say_bad')->name('discuss.reply_say_bad');

});
//兌換遊戲首頁
Route::get('games/index','GameController@index')->name('game.index');

//討論區
Route::get('discuss/index','DiscussController@index')->name('discuss.index');

//公開的公告
Route::get('post/index', 'PostController@index')->name('post.index');
Route::post('post/view', 'PostController@view')->name('post.view');

//公開的學生作業
Route::get('student_task/index', 'StudentTaskController@index')->name('student_task.index');
Route::get('student_task/select', 'StudentTaskController@open')->name('student_task.select');
Route::any('student_task/open', 'StudentTaskController@open')->name('student_task.open');
Route::post('student_task/likes', 'StudentTaskController@likes')->name('student_task.likes');
Route::post('student_task/views', 'StudentTaskController@views')->name('student_task.views');
Route::get('student_task/view_one/{student_task}', 'StudentTaskController@view_one')->name('student_task.view_one');


//課程
Route::get('book/index', 'HomeController@book_index')->name('book_index');

//好站連結
Route::get('link/index', 'HomeController@link_index')->name('link_index');

//打字
Route::get('student_type/index', 'StudentTypeController@index')->name('student_type.index');

//取得頭像
Route::get('avatars/{user}', 'HomeController@getAvatar');

//取得遊戲
Route::get('game/{game_name}', 'GameController@getGame');

//取得檔案
Route::get('file/{student_task}', 'StudentTaskController@getFile');

//下載檔案
Route::get('download_file/{student_task}', 'StudentTaskController@downloadFile')->name('download_student_task');