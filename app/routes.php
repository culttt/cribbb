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

Route::get('test', function(){
  Session::put('key', 'yog');
    var_dump(Session::get('key'));
});

Route::get('session', function(){
  var_dump(Session::get('creds'));
});


Route::get('auth/twitter', array(
  'uses' => 'AuthController@twitter',
  'as' => 'auth.twitter'
));

Route::get('auth/callback', array(
  'uses' => 'AuthController@callback',
  'as' => 'auth.callback'
));

Route::get('auth/redirect', array(
  'uses' => 'AuthController@redirect',
  'as' => 'auth.redirect'
));
