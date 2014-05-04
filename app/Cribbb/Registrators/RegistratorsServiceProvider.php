<?php namespace Cribbb\Registrators;

use Illuminate\Support\ServiceProvider;
use Cribbb\Registrators\Validators\EmailValidator;
use Cribbb\Registrators\Validators\UsernameValidator;

class RegistratorsServiceProvider extends ServiceProvider {

  /**
   * Register the binding
   *
   * @return void
   */
  public function register()
  {
    $this->registerCredentialsRegistrator();
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
        $this->app->make('Cribbb\Repositories\User\UserRepository'),
        [ new UsernameValidator($app['validator']), new EmailValidator($app['validator']) ]
      );
    });
  }

}

