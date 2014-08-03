<?php namespace Cribbb\Users\Email;

use Assert\Assertion;

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
    Assertion::email($email);

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
