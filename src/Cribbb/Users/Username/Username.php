<?php namespace Cribbb\Users\Username;

use DomainException;

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
    if( ! preg_match('/^[\pL\pM\pN_-]+$/u', $username))
    {
      throw new DomainException;
    }

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
