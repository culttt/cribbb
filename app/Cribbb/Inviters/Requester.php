<?php namespace Cribbb\Inviters;

use Exception;
use Cribbb\Validators\Validable;
use Illuminate\Support\MessageBag;
use Cribbb\Repositories\Invite\InviteRepository;

class Requester extends AbstractInviter {

  /**
   * Invite Repository
   *
   * @var Cribbb\Repositories\Invite\InviteRepository
   */
  protected $inviteRepository;

  /**
   * An array of Validators
   *
   * @var array
   */
  protected $validators;

  /**
   * MessageBag errors
   *
   * @var Illuminate\Support\MessageBag;
   */
  protected $errors;

  /**
   * Create a new instance of the Invite Requester
   *
   * @param Cribbb\Repositories\Invite\InviteRepository $inviteRepository
   * @param array $validators
   * @return void
   */
  public function __construct(InviteRepository $inviteRepository, array $validators)
  {
    $this->inviteRepository = $inviteRepository;
    $this->validators = $validators;

    $this->errors = new MessageBag;
  }

  /**
   * Create a new Invite
   *
   * @param array $data
   * @return Illuminate\Database\Eloquent\Model
   */
  public function create(array $data, $referral = null)
  {
    if($this->runValidationChecks($data))
    {
      if($referral)
      {
        $referer = $this->inviteRepository->getBy('referral_code', $referral)->first();

        if($referer)
        {
          $referer->increment('referral_count');
        }
      }

      return $this->inviteRepository->create($data);
    }
  }

}
