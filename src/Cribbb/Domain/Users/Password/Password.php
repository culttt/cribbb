<?php namespace Cribbb\Domain\Users\Password;

use Assert\Assertion;

class Password {

  /**
   * @var string
   */
  private $password;

  /**
   * Create a new Password
   *
   * @param string $password
   * @return void
   */
  public function __construct($password)
  {
    Assertion::minLength($password, 8);

    $this->password = $password;
  }

  /**
   * Return the object as a string
   *
   * @return string
   */
  public function __toString()
  {
    return $this->password;
  }

}
