<?php namespace Cribbb\Inviters;

use Exception;
use Cribbb\Validators\Validable;
use Illuminate\Support\MessageBag;
use Cribbb\Repositories\Invite\InviteRepository;

class Requester {

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
   * Create a new instance of the Invite Creator
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
  public function create(array $data)
  {
    foreach($this->validators as $validator)
    {
      if($validator instanceof Validable)
      {
        if(! $validator->with($data)->passes())
        {
          $this->errors = $validator->errors();
        }
      }

      else
      {
        throw new Exception("{$validator} is not an instance of Cribbb\Validiators\Validable");
      }
    }

    if($this->errors->isEmpty())
    {
      return $this->inviteRepository->create($data);
    }
  }

  /**
   * Return the errors message bag
   *
   * @return Illuminate\Support\MessageBag
   */
  public function errors()
  {
    return $this->errors;
  }

}
