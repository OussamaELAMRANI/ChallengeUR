<?php

use Illuminate\Http\Request;


Route::prefix('auth')->group(function () {

    Route::post('sign-up', 'Api\AuthController@signUp');
    Route::post('sign-in', 'Api\AuthController@SignIn');

    // User Should be connected !
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'Api\AuthController@logout');
        Route::get('user', 'Api\AuthController@infos');
    });

});

Route::prefix('stores')->group(function () {


    Route::group(['middleware' => 'auth:api'], function () {

        Route::get('nearby', 'Api\ShopController@nearby');
        Route::get('favorite', 'Api\ShopController@favorite');
        Route::post('like', 'Api\ShopController@like');

        Route::delete('', 'Api\ShopController@detachShop');

    });


});
