<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
    Route::get('/', 'Client\PagesController@index')->name('index');

// Authentication Routes...
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login:get');
	Route::post('login', 'Auth\LoginController@login')->name('login:post');
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// if (env("CLTVO_DEV_MODE")){
// // Registration Routes...
// 	Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register:get');
// 	Route::post('register', 'Auth\RegisterController@register')->name('register:post');
// }

// Password Reset Routes...
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('pass_reset:get');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('pass_reset_email');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('pass_reset_token');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('pass_reset:post');

// set firstime Password
	Route::get('password/set/{user_email}', 'Auth\SetPasswordController@edit')->name('pass_set:get');
	Route::patch('password/set/{user_email}', 'Auth\SetPasswordController@update')->name('pass_set:patch');

// cambio de idiomas
    Route::get('lang/{language}','ChangeLanguageController@changeLang')->name('language');

// // Contact
//     Route::post('contact', 'Client\PagesController@contact')->name('contact');
