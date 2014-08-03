<?php namespace Cribbb\Users\Username;

use Assert\Assertion;

class Username {

  /**
   * @var string
   */
  private $username;

  /**
   * Create a new Username
   *
   * @param string $username
   * @return void
   */
  public function __construct($username)
  {
    Assertion::regex($username, '/^[\pL\pM\pN_-]+$/u');

    $this->username = $username;
  }

  /**
   * Return the object as a string
   *
   * @return string
   */
  public function __toString()
  {
    return $this->username;
  }

}
