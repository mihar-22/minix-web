<?php

Route::group(['prefix' => 'v1/auth'], function () {
    Route::post('register', 'RegisterController@register');

    Route::post('token', 'PasswordGrantController@issueToken');
    Route::post('token/refresh', 'PasswordGrantController@refreshToken');

    Route::post('password/reset', 'PasswordController@resetPassword');
    Route::post('password/reset/send', 'PasswordController@sendResetLink');
});
