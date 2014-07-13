<?php namespace Cribbb\Users\Email;

use DomainException;

class Email {

  /**
   * @var string
   */
  private $email;

  /**
   * Create a new Email
   *
   * @param string $email
   * @return void
   */
  public function __construct($email)
  {
    if( ! filter_var($email, FILTER_VALIDATE_EMAIL) !== false )
    {
      throw new DomainException;
    }

    $this->email = $email;
  }

  /**
   * Return the object as a string
   *
   * @return string
   */
  public function __toString()
  {
    return $this->email;
  }

}
