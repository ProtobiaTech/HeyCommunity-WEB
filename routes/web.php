<?php

//
// web view share info
include_once 'web-view-share.php';


//
// Home
Route::group([], function () {
    Route::get('home', function () {
        return redirect()->route('news.index');
    })->name('home');
    Route::get('/', function () {
        return redirect()->route('news.index');
    })->name('index');

    // Route::get('/', 'HomeController@index')->name('home.index');
});


//
// Other
Route::group([], function () {
    Route::post('simditor-upload-images', 'UploadController@simditorUploadImages')->name('upload.simditor-upload-images');
});


//
// User
Route::group(['prefix' => 'user', 'middleware' => []], function () {
    Route::group(['middleware' => 'auth'], function() {
        Route::get('logout', 'UserController@logout')->name('user.logout');
    });

    Route::group(['middleware' => 'guest'], function() {
        Route::get('log-in', 'UserController@login')->name('login');
        Route::get('login', 'UserController@login')->name('user.login');
        Route::get('signup', 'UserController@signup')->name('user.signup');

        Route::get('default-signup', 'UserController@defaultSignup')->name('user.default-signup');
        Route::post('default-signup', 'UserController@defaultSignupHandler')->name('user.default-signup-handler');
        Route::get('default-login', 'UserController@defaultLogin')->name('user.default-login');
        Route::post('default-login', 'UserController@defaultLoginHandler')->name('user.default-login-handler');

        Route::get('login-wechat', 'UserController@loginWechat')->name('user.login-wechat');
    });

    Route::get('login-by-wechat', 'UserController@loginByWechat')->middleware(['wechat.oauth', 'auth.wechat'])->name('user.login-by-wechat');
    Route::post('login-by-wechat-handler', 'UserController@loginByWechatHandler')->name('user.login-by-wechat-handler');
    Route::get('login-by-wechat-success', 'UserController@loginByWechatSuccess')->name('user.login-by-wechat-success');

    Route::middleware(['auth'])->group(function () {
        Route::get('ucenter', 'UserController@ucenter')->name('user.ucenter');
        Route::get('ucenter/my-timelines', 'UserController@ucenter')->name('user.ucenter.my-timelines');
        Route::get('ucenter/my-topics', 'UserController@ucenter')->name('user.ucenter.my-topics');
        Route::get('ucenter/my-topic-comments', 'UserController@ucenter')->name('user.ucenter.my-topic-comments');
        Route::get('ucenter/my-activities', 'UserController@ucenter')->name('user.ucenter.my-activities');
        Route::get('ucenter/my-activity-signups', 'UserController@ucenter')->name('user.ucenter.my-activity-signups');

        Route::get('profile', 'UserController@profile')->name('user.profile');
        Route::post('profile', 'UserController@profileUpdate')->name('user.profile-update');
    });

    Route::get('uhome/{id}', 'UserController@uhome')->name('user.uhome');
});


//
// Notice
Route::group(['prefix' => 'notice', 'middleware' => ['wechat.oauth', 'auth.wechat']], function () {
    Route::get('/', 'NoticeController@index')->name('notice.index');
    Route::post('check', 'NoticeController@check')->name('notice.check');
});


//
// News
Route::group(['prefix' => 'news', 'middleware' => ['wechat.oauth', 'auth.wechat']], function () {
    Route::get('/', 'NewsController@index')->name('news.index');
    Route::get('/{id}', 'NewsController@show')->name('news.show')->where('id', '[0-9]+');
});


//
// Topic
Route::group(['prefix' => 'topic', 'middleware' => ['wechat.oauth', 'auth.wechat']], function () {
    Route::get('/', 'TopicController@index')->name('topic.index');
    Route::get('/{id}', 'TopicController@show')->name('topic.show')->where('id', '[0-9]+');

    Route::middleware(['auth'])->group(function() {
        Route::get('create', 'TopicController@create')->name('topic.create');
        Route::get('edit/{id}', 'TopicController@edit')->name('topic.edit')->where('id', '[0-9]+');
        Route::post('update/{id}', 'TopicController@update')->name('topic.update')->where('id', '[0-9]+');
        Route::post('store', 'TopicController@store')->name('topic.store');
        Route::post('thumb', 'TopicController@thumb')->name('topic.thumb');
        Route::post('favorite', 'TopicController@favorite')->name('topic.favorite');
        Route::post('destroy', 'TopicController@destroy')->name('topic.destroy');

        // Topic Comment
        Route::group(['prefix' => 'comment'], function () {
            Route::post('store', 'TopicCommentController@store')->name('topic.comment.store');
            Route::post('reply', 'TopicCommentController@reply')->name('topic.comment.reply');
            Route::post('thumb', 'TopicCommentController@thumb')->name('topic.comment.thumb');
            Route::post('destroy', 'TopicCommentController@destroy')->name('topic.comment.destroy');
        });
    });
});


//
// Activity
Route::group(['prefix' => 'activity', 'middleware' => ['wechat.oauth', 'auth.wechat']], function () {
    Route::get('/', 'ActivityController@index')->name('activity.index');
    Route::get('/{id}', 'ActivityController@show')->name('activity.show')->where('id', '[0-9]+');

    Route::middleware(['auth'])->group(function() {
        Route::get('create', 'ActivityController@create')->name('activity.create');
        Route::post('store', 'ActivityController@store')->name('activity.store');
        Route::get('edit/{id}', 'ActivityController@edit')->name('activity.edit')->where('id', '[0-9]+');
        Route::post('update/{id}', 'ActivityController@update')->name('activity.update')->where('id', '[0-9]+');
    });
});


//
// web admin routes
include_once 'web-admin.php';
