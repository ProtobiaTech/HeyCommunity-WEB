<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
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
    });
});
