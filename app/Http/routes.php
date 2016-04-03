<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

// settings
Route::controllers([
    'settings/accounts' => 'Settings\AccountsController',
    'settings' => 'Settings\SettingsController'
]);

// authentication
Route::controllers([
	'auth'     => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// characters
Route::controller('character/{id}/{name?}', 'CharacterController');

// accounts
Route::controller('account/{id}/{name?}', 'AccountController');

// user
Route::controller('user/{id}/{name?}', 'UserController');

// search
Route::get('search', 'SearchController@getIndex');

// support
Route::get('contact', 'SupportController@getContact');
Route::post('contact', 'SupportController@postContact');
Route::get('contact/success', 'SupportController@getContactSuccess');

Route::get('about', 'SupportController@getAbout');
Route::get('terms', 'SupportController@getTerms');
Route::get('privacy', 'SupportController@getPrivacy');
Route::get('impressum', 'SupportController@getImpressum');

// sitemap
Route::controller('sitemap', 'SitemapController');

// admin
Route::controller('admin', 'AdminController');
