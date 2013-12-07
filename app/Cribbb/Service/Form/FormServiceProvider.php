<?php namespace Cribbb\Service\Form;

use Illuminate\Support\ServiceProvider;
use Cribbb\Service\Form\User\UserForm;
use Cribbb\Service\Form\User\UserFormLaravelValidator;

class FormServiceProvider extends ServiceProvider {

  /**
   * Register the binding
   *
   * @return void
   */
  public function register()
  {
    $app = $this->app;

    $app->bind('Cribbb\Service\Form\User\UserForm', function($app)
    {
      return new UserForm(
        new UserFormLaravelValidator( $app['validator'] ),
        $app->make('Cribbb\Repository\User\UserRepository')
      );
    });
  }

}
