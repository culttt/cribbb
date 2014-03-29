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
Route::get('/', array(
  'uses' => 'HomeController@index',
  'as' => 'home.index'
));

/**
 * Oauth
 *
 * Routes for authenticating with third-party
 * social authentication services
 */
Route::get('oauth/authorize', array(
  'uses' => 'OauthController@authorize',
  'as' => 'oauth.authorize'
));

Route::get('oauth/callback', array(
  'uses' => 'OauthController@callback',
  'as' => 'oauth.callback'
));

Route::get('oauth/register', array(
  'uses' => 'OauthController@register',
  'as' => 'oauth.register'
));

Route::post('oauth', array(
  'uses' => 'OauthController@store',
  'as' => 'oauth.store'
));
