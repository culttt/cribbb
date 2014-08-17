<?php namespace Cribbb\Domain\Model\Users;

class HashedPassword {

  /**
   * @var string
   */
  private $value;

  /**
   * Create a new Hashed Password
   *
   * @param string $value
   * @return void
   */
  public function __construct($value)
  {
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
