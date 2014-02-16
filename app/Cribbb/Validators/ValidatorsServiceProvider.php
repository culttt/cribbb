<?php namespace Cribbb\Validators;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ServiceProvider;
use Cribbb\Validators\User\UserCreateValidator;
use Cribbb\Validators\User\UserUpdateValidator;

class ValidatorsServiceProvider extends ServiceProvider {

  public function register()
  {
    $this->registerUserValidation();
  }

  /**
   * Register User Validation
   */
  protected function registerUserValidation()
  {
    $this->app->bind('Cribbb\Validators\User\UserCreateValidator', function($app)
    {
      return new UserCreateValidator( $app['validator'] );
    });

    $this->app->bind('Cribbb\Validators\User\UserUpdateValidator', function($app)
    {
      return new UserUpdateValidator( $app['validator'] );
    });
  }

}
