<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    //
    // Home
    Route::group(['prefix' => 'home'], function () {
        Route::get('/', 'HomeController@index')->name('admin.home.index');
    });
});
