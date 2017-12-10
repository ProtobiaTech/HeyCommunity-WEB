<?php

//
// web admin routes
include_once 'web-admin.php';


//
// system info
try {
    $system = \App\System::first();
} catch (Exception $e) {
    $system = new stdClass();
    $system->site_title = 'HeyCommunity';
    $system->site_subheading = 'A New HeyCommunity Site';
    $system->site_description = 'This Is A New HeyCommunity Site';
    $system->site_keywords = 'HeyCommunity, Social Site, Open Software';
    $system->site_analytic_code = null;
}
view()->share('system', $system);


//
// wechat js
try {
    $wechat = new \EasyWeChat\Foundation\Application(config('wechat'));
    $wechatJs = $wechat->js;
    $wechatJsConfig = $wechatJs->config(array('onMenuShareTimeline', 'onMenuShareAppMessage'));
    view()->share('wechatJsConfig', $wechatJsConfig);
} catch (Exception $e) {
    Log::alert($e->getMessage());
    view()->share('wechatJsConfig', '{}');
}



//
// Home
Route::group([], function () {
    Route::get('home', function () {
        return redirect()->route('topic.index');
    })->name('home');
    Route::get('/', function () {
        return redirect()->route('topic.index');
    })->name('index');

    // Route::get('/', 'HomeController@index')->name('home.index');
});


//
// User
Route::group(['prefix' => 'user'], function () {
    Route::get('default-signup', 'UserController@signup')->name('user.signup');
    Route::post('default-signup', 'UserController@signupHandler')->name('user.signup-handler');
    Route::get('default-login', 'UserController@login')->name('user.login');
    Route::post('default-login', 'UserController@loginHandler')->name('user.login-handler');

    Route::get('login', function () {
        return redirect()->route('user.login-wechat');
    })->name('user.login');
    Route::get('log-in', function () {
        return redirect()->route('user.login-wechat');
    })->name('login');
    Route::get('signup', function () {
        return redirect()->route('user.login-wechat');
    })->name('user.signup');
    Route::get('logout', 'UserController@logout')->name('user.logout');

    Route::get('login-wechat', 'UserController@loginWechat')->name('user.login-wechat');
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
Route::group(['prefix' => 'notification'], function () {
    Route::get('/', 'NotificationController@index')->name('notification.index');
});


//
// Topic
Route::group(['prefix' => 'topic'], function () {
    Route::get('/', 'TopicController@index')->name('topic.index');
    Route::get('/{id}', 'TopicController@show')->name('topic.show')->where('id', '[0-9]+');
    Route::get('create', 'TopicController@create')->name('topic.create')->middleware(['auth']);
    Route::post('store', 'TopicController@store')->name('topic.store')->middleware(['auth']);
    Route::post('thumb', 'TopicController@thumb')->name('topic.thumb')->middleware(['auth']);
    Route::post('favorite', 'TopicController@favorite')->name('topic.favorite')->middleware(['auth']);

    // Topic Comment
    Route::group(['prefix' => 'comment'], function () {
        Route::post('store', 'TopicCommentController@store')->name('topic.comment.store')->middleware(['auth']);
    });
});


//
// Activity
Route::group(['prefix' => 'activity'], function () {
    Route::get('/', 'ActivityController@index');
    Route::get('/{id}', 'ActivityController@show')->name('activity.show');
});

