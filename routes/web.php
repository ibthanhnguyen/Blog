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
//     return view('index');
// });

Auth::routes(['password.request' => false, 'reset' => false]);

Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/', 'HomeController@index');
Route::get('/cate/{id}', 'BlogController@blogOfCategory')->name('cate');
Route::get('/blog/{id}', 'BlogController@showBlogDetail')->name('blog');
Route::get('/sort', 'BlogController@sort')->name('sort');
Route::get('/sort-result', 'BlogController@sortResult')->name('sort-result');

Route::group(['prefix' => 'user', 'as' => 'user.'], function(){
    Route::get('/create-new-blog-post','BlogController@index')->middleware('auth')->name('createNewPost');
    Route::post('/create-new-blog-post', ['as' => 'createPost', 'uses' => 'BlogController@createNewPost']);

    Route::get('/list-posts', 'BlogController@listPosts')->middleware('auth')->name('list-posts');

    Route::post('/comment/{id}', ['as' => 'comment', 'uses' => 'CommentController@comment']);
});
