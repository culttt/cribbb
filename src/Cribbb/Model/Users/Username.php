<?php namespace Cribbb\Model\Users;

use Assert\Assertion;

class Username {

  /**
   * @var string
   */
  private $value;

  /**
   * Create a new Username
   *
   * @param string $username
   * @return void
   */
  public function __construct($value)
  {
    Assertion::regex($value, '/^[\pL\pM\pN_-]+$/u');

    $this->value = $value;
  }

  /**
   * Return the object as a string
   *
   * @return string
   */
  public function __toString()
  {
    return $this->value;
  }

}
