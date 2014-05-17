<?php namespace Cribbb\Registrators\Events;

use Carbon\Carbon;
use Illuminate\Mail\Mailer;
use Cribbb\Repositories\Invite\InviteRepository;

class NotifyInviterHandler {

  /**
   * The Mailer instance
   *
   * @var Illuminate\Mail\Mailer
   */
  protected $mailer;

  /**
   * The InvitateRepository
   *
   * @var Cribbb\Repositories\Invite\InviteRepository
   */
  protected $inviteRepository;

  /**
   * Create a new instance of the NotifyInviterHandler
   *
   * @param Illuminate\Mail\Mailer $mailer
   * @param Cribbb\Repositories\Invite\InviteRepository $inviteRepository
   * @return void
   */
  public function __construct(Mailer $mailer, InviteRepository $inviteRepository)
  {
    $this->mailer = $mailer;
    $this->inviteRepository = $inviteRepository;
  }

  /**
   * Send an email to the inviter to notify them that
   * their invitation was accepted.
   *
   * Mark the invitation as used
   *
   * @param User $user
   * @param string $code
   * @return void
   */
  public function handle($user, $code)
  {
    // Send the notification email

    $invite = $this->inviteRepository->getValidInviteByCode($code);
    $invite->claimed_at = Carbon::now();
    $invite->save();
  }

  /**
   * Register the listeners for the subscriber.
   *
   * @param Illuminate\Events\Dispatcher $events
   * @return array
   */
  public function subscribe($events)
  {
    $events->listen('user.invited', 'Cribbb\Registrators\Events\NotifyInviterHandler');
  }

}
