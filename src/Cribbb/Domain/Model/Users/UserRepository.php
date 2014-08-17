<?php namespace Cribbb\Domain\Model\Users;

interface UserRepository {

  /**
   * Find a user by their email address
   *
   * @param Email $email
   * @return User
   */
  public function userOfEmail(Email $email);

  /**
   * Find a user by their username
   *
   * @param Username $username
   * @return User
   */
  public function userOfUsername(Username $username);

}
