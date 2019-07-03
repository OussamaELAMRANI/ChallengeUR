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
