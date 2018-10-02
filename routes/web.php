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
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index', function(){
})->middleware('verified');

Route::get('/user', 'UserController@index');
Route::patch('/user/edit/{id}', 'UserController@update');
Route::patch('/user/{id}', 'UserController@updateImage');
Route::get('/users/regular/{id}', 'UserController@regular');
Route::get('/users/admin/{id}', 'UserController@admin');
Route::delete('/user/deactivate/{id}', 'UserController@deactivate');
Route::get('/user/activate/{id}', 'UserController@activate');

Route::get('/forum', 'ForumController@index');
Route::post('/forum/add', 'ForumController@add');
Route::post('/forum/store', 'ForumController@store');
Route::get('/forum/{name}/{id}', 'ForumController@show');
Route::get('/forum/{name}/{id}/post_thread', 'ForumController@post_thread');

Route::get('/category', 'CategoryController@index');
Route::delete('/categories/{id}', 'CategoryController@destroy');
Route::patch('/categories/{id}', 'CategoryController@update');


Route::post('/threads/{name}/{id}', 'ThreadController@store');
Route::get('/threads/{name}/{id}/{subject}/{thread_id}', 'ThreadController@show');
Route::delete('/thread/{id}', 'ThreadController@destroy');

Route::post('/forum/{id}/edit', 'ThreadController@edit');
Route::patch('/forum/{id}', 'ThreadController@update');

Route::post('/comments', 'CommentController@store');
Route::post('forum/comments', 'CommentController@store');
Route::post('/comments/{id}/edit', 'CommentController@edit');
Route::patch('/comments/{id}', 'CommentController@update');
Route::delete('/comments/{id}', 'CommentController@destroy');

Route::post('/search', 'SearchController@index');

Route::post('/reports/{id}', 'ReportController@store');
Route::post('/comment_reports/{id}', 'ReportController@comment_store');

Route::get('/{id}/like', 'LikeController@store');
Route::get('/{id}/unlike', 'LikeController@unstore');


Route::get('/search', 'SearchController@search');
// Route::view('/search', 'search');

// Route::get('/forum/find', 'SearchController@searchThreads');
// Route::get('autocomplete-search',array('as'=>'autocomplete.search','uses'=>'SearchController@search'));

// Route::get('autocomplete-ajax',array('as'=>'autocomplete.ajax','uses'=>'SearchController@ajaxData'));
// Auth::routes();

