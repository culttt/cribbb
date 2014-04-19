<?php namespace Cribbb\Inviters;

use Illuminate\Support\ServiceProvider;
use Cribbb\Inviters\Validators\EmailValidator;
use Cribbb\Inviters\Policies\UserHasInvitations;

class InvitersServiceProvider extends ServiceProvider {

  /**
   * Register the binding
   *
   * @return void
   */
  public function register()
  {
    $this->registerRequester();
    $this->registerInviter();
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

  /**
   * Register the Inviter service
   *
   * @return void
   */
  public function registerInviter()
  {
    $this->app->bind('Cribbb\Inviters\Inviter', function($app){
      return new Inviter(
        $this->app->make('Cribbb\Repositories\Invite\InviteRepository'),
        array( new EmailValidator($app['validator']) ),
        array( new UserHasInvitations )
      );
    });
  }

}

