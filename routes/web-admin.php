<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'HomeController@index')->name('admin.home');

    //
    // Home
    Route::group(['prefix' => 'home'], function () {
        Route::get('/', 'HomeController@index')->name('admin.home.index');
    });


    //
    // Topic
    Route::group(['prefix' => 'topic'], function () {
        Route::get('/', 'TopicController@index')->name('admin.topic.index');

        Route::group(['prefix' => 'node'], function () {
            Route::get('/', 'TopicNodeController@index')->name('admin.topic.node.index');
            Route::post('to-left', 'TopicNodeController@toLeft')->name('admin.topic.node.to-left');
            Route::post('to-right', 'TopicNodeController@toRight')->name('admin.topic.node.to-right');
            Route::post('destroy', 'TopicNodeController@destroy')->name('admin.topic.node.destroy');
            Route::post('store', 'TopicNodeController@store')->name('admin.topic.node.store');
            Route::post('update', 'TopicNodeController@update')->name('admin.topic.node.update');
        });
    });


    //
    // System
    Route::group(['prefix' => 'system'], function () {
        Route::get('edit', 'SystemController@edit')->name('admin.system.edit');
        Route::post('update', 'SystemController@update')->name('admin.system.update');
    });
});
