<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'HomeController@index')->name('admin.home');

    //
    // Home
    Route::group(['prefix' => 'home'], function () {
        Route::get('/', 'HomeController@index')->name('admin.home.index');
    });


    //
    // Home
    Route::group(['prefix' => 'topic'], function () {
        Route::get('/', 'TopicController@index')->name('admin.topic.index');

        Route::get('node', 'TopicNodeController@index')->name('admin.topic.node.index');
        Route::post('node-to-left', 'TopicNodeController@nodeToLeft')->name('admin.topic.node.to-left');
        Route::post('node-to-right', 'TopicNodeController@nodeToRight')->name('admin.topic.node.to-right');
        Route::post('node-destroy', 'TopicNodeController@nodeDestroy')->name('admin.topic.node.destroy');
    });
});
