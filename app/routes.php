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
 * Home (Feed)
 */
Route::get('/', array(
  'uses' => 'HomeController@index',
  'as' => 'home.index'
));
Route::get('feed', array(
  'before' => 'auth',
  'uses' => 'HomeController@index',
  'as' => 'home.feed'
));

Route::resource('user', 'UserController');

/**
 * Login
 */
Route::get('login', array(
  'uses' => 'SessionController@create',
  'as' => 'session.create'
));
Route::post('login', array(
  'uses' => 'SessionController@store',
  'as' => 'session.store'
));
Route::get('logout', array(
  'uses' => 'SessionController@destroy',
  'as' => 'session.destroy'
));

/**
 * Register
 */
Route::get('register', array(
  'uses' => 'RegisterController@index',
  'as' => 'register.index'
));
Route::post('register', array(
  'uses' => 'RegisterController@store',
  'as' => 'register.store'
));

/**
 * Password Reset
 */
Route::get('password/reset', array(
  'uses' => 'PasswordController@remind',
  'as' => 'password.remind'
));
Route::post('password/reset', array(
  'uses' => 'PasswordController@request',
  'as' => 'password.request'
));
Route::get('password/reset/{token}', array(
  'uses' => 'PasswordController@reset',
  'as' => 'password.reset'
));
Route::post('password/reset/{token}', array(
  'uses' => 'PasswordController@update',
  'as' => 'password.update'
));

/**
 * Posts
 */
Route::get('post', array(
  'uses' => 'PostController@index',
  'as' => 'post.index'
));
Route::get('post/create', array(
  'before' => 'auth',
  'uses' => 'PostController@create',
  'as' => 'post.create'
));
Route::get('post/{id}', array(
  'uses' => 'PostController@show',
  'as' => 'post.show'
));
Route::post('post', array(
  'before' => 'auth',
  'uses' => 'PostController@store',
  'as' => 'post.store'
));
Route::get('post/{id}/edit', array(
  'before' => 'auth',
  'uses' => 'PostController@edit',
  'as' => 'post.edit'
));
Route::put('post/{id}', array(
  'before' => 'auth',
  'uses' => 'PostController@update',
  'as' => 'post.update'
));
Route::delete('post/{id}', array(
  'before' => 'auth',
  'uses' => 'PostController@destroy',
  'as' => 'post.destory'
));
