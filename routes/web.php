<?php

include_once 'web-admin.php';

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

//
// Home
Route::group([], function () {
    Route::get('home', function () {
        return redirect()->route('topic.index');
    });
    Route::get('/', function () {
        return redirect()->route('topic.index');
    });

    // Route::get('/', 'HomeController@index')->name('home.index');
});


//
// User
Route::group(['prefix' => 'user'], function () {
    Route::get('signup', 'UserController@signup')->name('user.signup');
    Route::post('signup', 'UserController@signupHandler')->name('user.signup-handler');
    Route::get('login', 'UserController@login')->name('user.login');
    Route::post('login', 'UserController@loginHandler')->name('user.login-handler');
    Route::get('logout', 'UserController@logout')->name('user.logout');

    Route::get('ucenter', 'UserController@ucenter')->name('user.ucenter');
    Route::get('profile', 'UserController@profile')->name('user.profile');
    Route::post('profile', 'UserController@profileUpdate')->name('user.profile-update');
    Route::get('uhome/{id}', 'UserController@uhome')->name('user.uhome');
});


//
// Notice
Route::group(['prefix' => 'notification'], function () {
    Route::get('/', 'NotificationController@index')->name('notification.index');
});


//
// Topic
Route::group(['prefix' => 'topic'], function () {
    Route::get('/', 'TopicController@index')->name('topic.index');
    Route::get('/{id}', 'TopicController@show')->name('topic.show')->where('id', '[0-9]+');
    Route::get('create', 'TopicController@create')->name('topic.create');
    Route::post('store', 'TopicController@store')->name('topic.store');
    Route::post('thumb', 'TopicController@thumb')->name('topic.thumb');
    Route::post('favorite', 'TopicController@favorite')->name('topic.favorite');

    // Topic Comment
    Route::group(['prefix' => 'comment'], function () {
        Route::post('store', 'TopicCommentController@store')->name('topic.comment.store');
    });
});


//
// Activity
Route::group(['prefix' => 'activity'], function () {
    Route::get('/', 'ActivityController@index');
    Route::get('/{id}', 'ActivityController@show')->name('activity.show');
});

