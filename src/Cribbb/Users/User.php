<?php namespace Cribbb\Users;

use Doctrine\ORM\Mapping as ORM;
use Cribbb\Users\Username\Username;
/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User {

  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string")
   */
  private $email;

  /**
   * @ORM\Column(type="string")
   */
  private $username;

  /**
   * @ORM\Column(type="string")
   */
  private $password;

  public function __construct(Email $email, Username $username, Password $password)
  {
    $this->setEmail($email);
    $this->setUsername($username);
    $this->setPassword($password);
  }

  public function getId()
  {
    return $this->id;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail(Email $email)
  {
    $this->email = $email;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function setUsername(Username $username)
  {
    $this->username = $username;
  }

  public function getPassword()
  {
    return $this->username;
  }

  public function setPassword(Password $password)
  {
    $this->password = $password;
  }

}
