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
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login:get');
Route::post('login', 'Auth\LoginController@login')->name('login:post');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

if (config("cltvo.open_register") && config("cltvo.open_site")){
	// Registration Routes...
	Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register:get');
	Route::post('register', 'Auth\RegisterController@register')->name('register:post');
}

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

// Contact
    Route::post('contact', 'Client\PagesController@contact')->name('contact');

Route::group(["as" => "pages."], function(){

	Route::resource('/','Client\PagesController', [
		'only' => [ 'index', 'show'],
		'parameters' => ['' => 'public_page']
	]);

	Route::get('{public_page}/{public_child_page}','Client\PagesController@showChild')->name('showChild');
});
