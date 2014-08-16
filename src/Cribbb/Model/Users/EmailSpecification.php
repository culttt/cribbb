<?php namespace Cribbb\Model\Users;

interface EmailSpecification {

  /**
   * Check to see if the specification is satisfied
   *
   * @return bool
   */
  public function isSatisfiedBy(Email $username);

}
