<?php namespace Cribbb\Registrators;

use Illuminate\Support\ServiceProvider;
use Cribbb\Registrators\Validators\UidValidator;
use Cribbb\Registrators\Validators\EmailValidator;
use Cribbb\Registrators\Validators\UsernameValidator;
use Cribbb\Registrators\Validators\OauthTokenValidator;

class RegistratorsServiceProvider extends ServiceProvider {

  /**
   * Register the binding
   *
   * @return void
   */
  public function register()
  {
    $this->registerCredentialsRegistrator();
    $this->registerSocialProviderRegistrator();
    $this->registerEventHandlers();
  }

  /**
   * Register the CredentialsRegistrator service
   *
   * @return void
   */
  public function registerCredentialsRegistrator()
  {
    $this->app->bind('Cribbb\Registrators\CredentialsRegistrator', function($app)
    {
      return new CredentialsRegistrator(
        $app->make('Cribbb\Repositories\User\UserRepository'),
        $app['events'],
        [ new UsernameValidator($app['validator']), new EmailValidator($app['validator']) ]
      );
    });
  }

  /**
   * Register the CredentialsRegistrator service
   *
   * @return void
   */
  public function registerSocialProviderRegistrator()
  {
    $this->app->bind('Cribbb\Registrators\SocialProviderRegistrator', function($app)
    {
      return new SocialProviderRegistrator(
        $app->make('Cribbb\Repositories\User\UserRepository'),
        $app['events'],
        [
          new UsernameValidator($app['validator']),
          new EmailValidator($app['validator']),
          new OauthTokenValidator($app['validator']),
          new UidValidator($app['validator'])
        ]
      );
    });
  }

  /**
   * Register the Event handlers
   *
   * @return void
   */
  public function registerEventHandlers()
  {
    $this->app->events->listen('user.register', 'Cribbb\Registrators\Events\WelcomeEmailHandler');
  }

}
