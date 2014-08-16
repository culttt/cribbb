<?php namespace Cribbb\Model\Users;

class EmailIsUnique implements EmailSpecification {

  /**
   * @var Cribbb\Model\Users\UserRepository
   */
  private $repository;

  /**
   * Create a new instance of the EmailIsUnique specification
   *
   * @param Cribbb\Model\Users\UserRepository $repository
   */
  public function __construct(UserRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Check to see if the specification is satisfied
   *
   * @param Cribbb\Model\Users\Email $email
   * @return bool
   */
  public function isSatisfiedBy(Email $email)
  {
    if($this->repository->findBy(['email' => $email]))
    {
      return false;
    }

    return true;
  }

}
