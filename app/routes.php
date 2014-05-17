<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Home
 *
 * The root of the application. This will either be
 * the index page or the user's dashboard
 */
Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home.index']);

/**
 * Invite
 *
 * The route to create a new Invite
 */
Route::get('request', ['uses' => 'InviteController@request', 'as' => 'invite.request']);
Route::post('invite', ['uses' => 'InviteController@store', 'as' => 'invite.store']);

/**
 * Register
 *
 * Sign up as a new user
 */
Route::get('register',  ['uses' => 'RegisterController@index', 'as' => 'register.index']);
Route::post('register', ['uses' => 'RegisterController@store', 'as' => 'register.store']);

/**
 * Social Authentication
 *
 * Authenticate via a social provider
 */
Route::get('auth/register',             ['uses' => 'AuthenticateController@register',   'as' => 'authenticate.register']);
Route::get('auth/{provider}',           ['uses' => 'AuthenticateController@authorise',  'as' => 'authenticate.authorise']);
Route::get('auth/{provider}/callback',  ['uses' => 'AuthenticateController@callback',   'as' => 'authenticate.callback']);
Route::post('auth',                     ['uses' => 'AuthenticateController@store',      'as' => 'authenticate.store']);

/**
 * Authentication
 *
 * Allow a user to log in and log out of the application
 */
Route::get('login',             ['uses' => 'SessionController@create',    'as' => 'session.create']);
Route::get('login/{provider}',  ['uses' => 'SessionController@authorise', 'as' => 'session.authorise']);
Route::post('login',            ['uses' => 'SessionController@store',     'as' => 'session.store']);
Route::delete('logout',         ['uses' => 'SessionController@destroy',   'as' => 'session.destroy']);
