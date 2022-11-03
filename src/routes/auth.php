<?php

Route::group([

    'namespace' => 'BrandStudio\Auth\Http\Controllers',
    'prefix' => config('brandstudio.auth.route_prefix'),

], function() {

    Route::group([

        'middleware' => ['auth:api'],

    ], function() {

        Route::get('user', 'AuthController@getUser');

        Route::group([
            'middleware' => config('brandstudio.auth.route_middlewares'),
        ], function() {
            Route::put('user', 'AuthController@updateLogin');
            Route::delete('user', 'AuthController@delete');
        });
    });

    Route::group([

        'middleware' => config('brandstudio.auth.route_middlewares'),

    ], function() {

        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');

        Route::post('password', 'AuthController@resetPassword');
        Route::put('password', 'AuthController@updatePassword')->middleware('auth:api');

        Route::get('verify', 'AuthController@verify')->name('bs-auth-verify');
        // TODO: refresh token

    });


});
