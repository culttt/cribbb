<?php namespace Cribbb\Domain\Model\Identity;

interface HashingService {

  /**
   * Create a new HashedPassword
   *
   * @param Password $password
   * @return HashedPassword
   */
  public function make(Password $password);

  /**
   * Check if the password is valid
   *
   * @param Password $password
   * @param HashedPassword $hashed
   * @return bool
   */
  public function check(Password $password, HashedPassword $hashed);

}
