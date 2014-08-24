<?php namespace Cribbb\Application\Commands;

use Cribbb\Gettable;
use Assert\Assertion;

class RegisterUserCommand {

  use Gettable;

  /**
   * @var string
   */
  private $email;

  /**
   * @var string
   */
  private $username;

  /**
   * @var string
   */
  private $password;

  /**
   * Create a new RegisterUserCommand instance
   *
   * @param string $email
   * @param string $username
   * @param string $password
   */
  public function __construct($email, $username, $password)
  {
    Assertion::email($email);
    Assertion::string($username);
    Assertion::string($password);

    $this->email = $email;
    $this->username = $username;
    $this->password = $password;
  }

}
