<?php namespace Cribbb\Domain\Model\Users;

class UsernameIsUnique implements UsernameSpecification {

  /**
   * @var Cribbb\Domain\Model\Users\UserRepository
   */
  private $repository;

  /**
   * Create a new instance of the UsernameIsUnique specification
   *
   * @param Cribbb\Domain\Model\Users\UserRepository $repository
   */
  public function __construct(UserRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Check to see if the specification is satisfied
   *
   * @param Cribbb\Domain\Model\Users\Username $username
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
