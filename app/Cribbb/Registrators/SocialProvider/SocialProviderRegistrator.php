<?php namespace Cribbb\Registrators\SocialProvider;

use Cribbb\Validators\Validable;
use Cribbb\Repositories\UserRepository;

class SocialProviderRegistrator implements Registrator {

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
  public function __construct(Validable $validator, UserRepository $repository)
  {
    $this->validator = $validator;
    $this->repository = $repository;
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
  }

}
