<?php namespace Cribbb\Inviters;

use User;
use Exception;
use Illuminate\Support\MessageBag;
use Cribbb\Inviters\Policies\Policy;
use Cribbb\Repositories\Invite\InviteRepository;

class Inviter extends AbstractInviter {

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
   * An array of Policies
   *
   * @var array
   */
  protected $policies;

  /**
   * MessageBag errors
   *
   * @var Illuminate\Support\MessageBag;
   */
  protected $errors;

  /**
   * Create a new instance of the Invite Inviter
   *
   * @param Cribbb\Repositories\Invite\InviteRepository $inviteRepository
   * @param array $validators
   * @return void
   */
  public function __construct(InviteRepository $inviteRepository, array $validators, array $policies)
  {
    $this->inviteRepository = $inviteRepository;
    $this->validators = $validators;
    $this->policies = $policies;

    $this->errors = new MessageBag;
  }

  /**
   * Create a new Invite
   *
   * @param array User
   * @param array $data
   * @return Illuminate\Database\Eloquent\Model
   */
  public function create(User $user, $data)
  {
    $data = array_merge($data, ['referrer_id' => $user->id]);

    foreach($this->policies as $policy)
    {
      if($policy instanceof Policy)
      {
        $policy->run($user);
      }

      else
      {
        throw new Exception("{$policy} is not an instance of Cribbb\Inviters\Policies\Policy");
      }
    }

    if($this->runValidationChecks($data))
    {
      return $this->inviteRepository->create($data);
    }
  }

}
