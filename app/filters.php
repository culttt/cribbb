<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/*
|--------------------------------------------------------------------------
| Invitation Filter
|--------------------------------------------------------------------------
|
| The invite filter will only allow requests that include a valid
| "code" as part of the query string to access the given route.
| If the request does not have a valid code in the query
| string a "404 Not Found" response will be returned
|
*/

Route::filter('invite', function()
{
  if (! Input::has('code') and ! Session::has('invitation_code'))
  {
    return App::abort(404);
  }

  if(Input::has('code'))
  {
    $repository = App::make('Cribbb\Repositories\Invite\InviteRepository');

    $invite = $repository->getValidInviteByCode(Input::get('code'));

    if(! $invite)
    {
      return App::abort(404);
    }

    Session::put('invitation_code', Input::get('code'));
    Session::put('referrer_id', $invite->referrer_id);
  }
});
