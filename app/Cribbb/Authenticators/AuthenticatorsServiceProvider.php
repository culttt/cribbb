<?php namespace Cribbb\Authenticators;

use Illuminate\Support\ServiceProvider;
use League\OAuth1\Client\Server\Twitter;
use Cribbb\Authenticators\Providers\League\LeagueTwitterProvider;

class AuthenticatorsServiceProvider extends ServiceProvider {

  /**
   * Register
   */
  public function register()
  {
    $this->registerTwitterAuthenticator();
  }

  /**
   * Register Twitter Authenticator
   */
  public function registerTwitterAuthenticator()
  {
    $this->app->bind('Cribbb\Authenticators\Providers\Twitter', function($app)
    {
      return new LeagueTwitterProvider(new Twitter(array(
        'identifier'    => 'QGgWdfVnsjqDo7fmjlT1Q',
        'secret'        => 'v96mqnwIfs3BQ8XFJqr8gxrjDXwbCqRrdIUT1TpCY4',
        'callback_uri'  => "http://cribbb.dev/auth/callback",
      )));
    });
  }

}
