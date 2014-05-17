<?php namespace Cribbb\Registrators;

use Illuminate\Support\ServiceProvider;
use Cribbb\Registrators\Validators\UidValidator;
use Cribbb\Registrators\Validators\EmailValidator;
use Cribbb\Registrators\Events\WelcomeEmailHandler;
use Cribbb\Registrators\Events\NotifyInviterHandler;
use Cribbb\Registrators\Validators\UsernameValidator;
use Cribbb\Registrators\Validators\OauthTokenValidator;

class RegistratorsServiceProvider extends ServiceProvider {

  /**
   * Boot the Registrator Events
   *
   * @return void
   */
  public function boot()
  {
    $this->app->events->subscribe(new WelcomeEmailHandler(
      $this->app['mailer'])
    );
    $this->app->events->subscribe(new NotifyInviterHandler(
      $this->app['mailer'],
      $this->app->make('Cribbb\Repositories\Invite\InviteRepository'))
    );
  }

  /**
   * Register the binding
   *
   * @return void
   */
  public function register()
  {
    $this->registerCredentialsRegistrator();
    $this->registerSocialProviderRegistrator();
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

}
