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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
Route::get('/top','PostsController@index');
Route::get('/post/{id}/delete', 'PostsController@delete');
Route::post('/create','PostsController@create');
Route::post('/update','PostsController@update');

//プロフィール
Route::get('/profile','UsersController@profile');
Route::post('/profile','UsersController@update');


//ユーザー検索のページ
Route::get('/searchUser','UsersController@searchUser');
Route::post('/searchUser','UsersController@searchUser');

Route::get('/follow-list','PostsController@index');
Route::get('/follower-list','PostsController@index');



//フォローする
Route::get('/follow/{id}','FollowsController@follow');
//フォローを外す
Route::get('/unFollow/{id}','FollowsController@unFollow');
//フォローリスト
Route::get('/follow-list','FollowsController@followList');
//フォロワーリスト
Route::get('/follower-list','FollowsController@followerList');
//相手のプロフィール
Route::get('/otherProfile/{id}','FollowsController@otherProfile');

//ログアウト
Route::get('logout', 'Auth\LoginController@logout');
