<?php namespace Cribbb\Domain\Model\Users;

class UsernameIsUnique implements UsernameSpecification {

  /**
   * @var UserRepository
   */
  private $repository;

  /**
   * Create a new instance of the UsernameIsUnique specification
   *
   * @param UserRepository $repository
   */
  public function __construct(UserRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Check to see if the specification is satisfied
   *
   * @param Username $username
   * @return bool
   */
  public function isSatisfiedBy(Username $username)
  {
    if($this->repository->userOfUsername($username))
    {
      return false;
    }

    return true;
  }

}
