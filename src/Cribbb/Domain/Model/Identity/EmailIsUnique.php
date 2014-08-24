<?php namespace Cribbb\Domain\Model\Identity;

class EmailIsUnique implements EmailSpecification {

  /**
   * @var UserRepository
   */
  private $repository;

  /**
   * Create a new instance of the EmailIsUnique specification
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
   * @param Email $email
   * @return bool
   */
  public function isSatisfiedBy(Email $email)
  {
    if($this->repository->userOfEmail($email))
    {
      return false;
    }

    return true;
  }

}
