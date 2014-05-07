<?php namespace Cribbb\Authenticators;

use Illuminate\Support\ServiceProvider;
use League\OAuth1\Client\Server\Twitter;

class AuthenticatorsServiceProvider extends ServiceProvider {

  /**
   * Register each authentication provider
   *
   * @return void
   */
  public function register()
  {
    $this->registerManager();
    $this->registerTwitterAuthenticator();
  }

  /**
   * Inject the provders into the Manager class
   *
   * @return void
   */
  public function boot()
  {
    $this->app['auth.providers.manager']->set('twitter', $this->app['auth.providers.twitter']);
  }

  /**
   * Register the Manager class
   *
   * @return void
   */
  public function registerManager()
  {
    $this->app['auth.providers.manager'] = $this->app->share(function($app)
    {
      return new Manager;
    });

    $this->app->bind('Cribbb\Authenticators\Manager', function($app)
    {
      return $app['auth.providers.manager'];
    });
  }

  /**
   * Register Twitter Authenticator
   *
   * @return void
   */
  public function registerTwitterAuthenticator()
  {
    $this->app['auth.providers.twitter'] = $this->app->share(function($app)
    {
      return new Twitter(array(
        'identifier'    => $app['config']->get('auth.providers.twitter.identifier'),
        'secret'        => $app['config']->get('auth.providers.twitter.secret'),
        'callback_uri'  => $app['config']->get('auth.providers.twitter.callback_uri')
      ));
    });
  }

}
