<?php namespace Cribbb\Domain\Model\Users;

class EmailIsUnique implements EmailSpecification {

  /**
   * @var Cribbb\Domain\Model\Users\UserRepository
   */
  private $repository;

  /**
   * Create a new instance of the EmailIsUnique specification
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
   * @param Cribbb\Domain\Model\Users\Email $email
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
