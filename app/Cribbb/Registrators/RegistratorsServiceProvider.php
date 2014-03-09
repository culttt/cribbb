<?php namespace Cribbb\Registrators;

use Illuminate\Support\ServiceProvider;
use Cribbb\Registrators\SocialProvider\SocialProviderRegistrator;
use Cribbb\Registrators\SocialProvider\Validator as SocialProviderValidator;

class RegistratorsServiceProvider extends ServiceProvider {

  /**
   * Register
   */
  public function register()
  {
    $this->registerSocialProviderRegistrator();
  }

  /**
   * Register Social Provider Registrator
   */
  public function registerSocialProviderRegistrator()
  {
    $this->app->bind('Cribbb\Registrators\SocialProvider\SocialProviderRegistrator', function($app)
    {
      return new SocialProviderRegistrator(
        $app->make('Cribbb\Repositories\User\UserRepository'),
        new SocialProviderValidator($app->make('validator'))
      );
    });
  }

}
