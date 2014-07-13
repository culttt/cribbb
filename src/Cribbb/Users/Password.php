<?php namespace Cribbb\Users;

use DomainException;

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
    if( strlen($password) < 8 )
    {
      throw new DomainException;
    }

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
