<?php namespace Cribbb\Inviters;

use Illuminate\Support\ServiceProvider;
use Cribbb\Inviters\Validators\EmailValidator;

class InvitersServiceProvider extends ServiceProvider {

  /**
   * Register the binding
   *
   * @return void
   */
  public function register()
  {
    $this->registerRequester();
  }

  /**
   * Register the Requester service
   *
   * @return void
   */
  public function registerRequester()
  {
    $this->app->bind('Cribbb\Inviters\Requester', function($app)
    {
      return new Requester(
        $this->app->make('Cribbb\Repositories\Invite\InviteRepository'),
        array( new EmailValidator($app['validator']) )
      );
    });
  }

}

