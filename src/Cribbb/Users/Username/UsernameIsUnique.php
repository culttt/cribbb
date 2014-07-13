<?php namespace Cribbb\Users\Username;

use Cribbb\Users\UserRepository;

class UsernameIsUnique implements UsernameSpecification {

  /**
   * @var Cribbb\Users\UserRepository
   */
  private $repository;

  /**
   * Create a new instance of the UsernameIsUnique specification
   *
   * @param Cribbb\Users\UserRepository $repository
   */
  public function __construct(UserRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Check to see if the specification is satisfied
   *
   * @return bool
   */
  public function isSatisfiedBy(Username $username)
  {
    if($this->repository->findBy(['username' => $username]))
    {
      return false;
    }

    return true;
  }

}
