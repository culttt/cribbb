<?php namespace Cribbb\Registrators\SocialProvider;

use Cribbb\Validators\Validable;
use Illuminate\Support\MessageBag;
use Cribbb\Registrators\Registrator;
use Cribbb\Repositories\User\UserRepository;
use Cribbb\Registrators\AbstractRegistrator;

class SocialProviderRegistrator extends AbstractRegistrator implements Registrator {

  /**
   * Validator instance
   *
   * @var Validable
   */
  protected $validator;

  /**
   * The User Repository
   *
   * @var UserRepository
   */
  protected $repository;

  /**
   * Create a new instance of the SocialProviderRegistrator
   *
   * @param Validable $validator
   */
  public function __construct(UserRepository $repository, Validable $validator)
  {
    $this->validator = $validator;
    $this->repository = $repository;

    parent::__construct(new MessageBag);
  }

  /**
   * Create a new user from an array of input data
   *
   * @param array $data
   * @return Illuminate\Database\Eloquent\Model
   */
  public function create(array $data)
  {
    // Validate
    if($this->validator->with($data)->passes())
    {
      // Create
      return $this->repository->create($data);
    }

    $this->errors = $this->validator->errors();
  }

}
