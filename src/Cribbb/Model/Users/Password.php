<?php namespace Cribbb\Model\Users;

use Assert\Assertion;

class Password {

  /**
   * @var string
   */
  private $value;

  /**
   * Create a new Password
   *
   * @param string $value
   * @return void
   */
  public function __construct($value)
  {
    Assertion::minLength($value, 8);

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
