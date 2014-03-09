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
        'identifier'    => $app['config']->get('auth.providers.twitter.identifier'),
        'secret'        => $app['config']->get('auth.providers.twitter.secret'),
        'callback_uri'  => $app['config']->get('auth.providers.twitter.callback_uri')
      )));
    });
  }

}
