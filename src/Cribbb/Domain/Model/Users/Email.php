<?php namespace Cribbb\Domain\Model\Users;

use Assert\Assertion;

class Email {

  /**
   * @var string
   */
  private $value;

  /**
   * Create a new Email
   *
   * @param string $value
   * @return void
   */
  public function __construct($value)
  {
    Assertion::email($value);

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
