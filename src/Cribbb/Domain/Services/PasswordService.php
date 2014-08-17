<?php namespace Cribbb\Domain\Services;

use Cribbb\Domain\Model\Users\Password;
use Cribbb\Domain\Model\Users\HashedPassword;

interface PasswordService {

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
