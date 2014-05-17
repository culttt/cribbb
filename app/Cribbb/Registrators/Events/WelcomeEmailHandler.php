<?php namespace Cribbb\Registrators\Events;

use Illuminate\Mail\Mailer;

class WelcomeEmailHandler {

  /**
   * The Mailer instance
   *
   * @var Illuminate\Mail\Mailer
   */
  protected $mailer;

  /**
   * Create a new instance of the WelcomeEmailHandler
   *
   * @param Illuminate\Mail\Mailer $mailer
   * @return void
   */
  public function __construct(Mailer $mailer)
  {
    $this->mailer = $mailer;
  }

  /**
   * Send a welcome email to the new user
   *
   * @return void
   */
  public function handle($user)
  {
    // Send the welcome email
  }

  /**
   * Register the listeners for the subscriber.
   *
   * @param Illuminate\Events\Dispatcher $events
   * @return array
   */
  public function subscribe($events)
  {
    $events->listen('user.register', 'Cribbb\Registrators\Events\WelcomeEmailHandler@handle');
  }

}
