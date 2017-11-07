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
    return redirect('/activity');
});


//
// Topic
Route::group(['prefix' => 'topic'], function() {
    Route::get('/', 'TopicController@index')->name('topic.index');
    Route::get('/{id}', 'TopicController@show')->name('topic.show');
    Route::get('create', 'TopicController@create')->name('topic.create');
});


//
// Activity
Route::group(['prefix' => 'activity'], function() {
    Route::get('/', 'ActivityController@index');
    Route::get('/{id}', 'ActivityController@show')->name('activity.show');
});

