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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/threads', 'ThreadController@index')->name('threads');
Route::post('/threads', 'ThreadController@store');
Route::get('/threads/create', 'ThreadController@create');
Route::get('/threads/{category}', 'ThreadController@index');
Route::get('/threads/{category}/{thread}', 'ThreadController@show');
Route::delete('/threads/{category}/{thread}', 'ThreadController@destroy');

Route::get('/threads/{category}/{thread}/replies', 'ReplyController@index');
Route::post('/threads/{category}/{thread}/replies', 'ReplyController@store');
Route::delete('/replies/{reply}', 'ReplyController@destroy');
Route::patch('/replies/{reply}', 'ReplyController@update');

Route::post('/threads/{category}/{thread}/subscriptions', 'ThreadSubscriptionController@store');
Route::delete('/threads/{category}/{thread}/subscriptions', 'ThreadSubscriptionController@destroy');

Route::post('/replies/{reply}/favorites', 'FavoriteController@store');
Route::delete('/replies/{reply}/favorites', 'FavoriteController@destroy');

Route::get('/profiles/{user}', 'ProfileController@show')->name('profile');
Route::get('/profiles/{user}/notifications', 'UserNotificationController@index');
Route::delete('/profiles/{user}/notifications/{notification}', 'UserNotificationController@destroy');