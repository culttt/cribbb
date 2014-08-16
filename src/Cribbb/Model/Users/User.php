<?php namespace Cribbb\Model\Users;

use Doctrine\ORM\Mapping as ORM;
use Cribbb\Model\Users\Email;
use Cribbb\Model\Users\Username;
use Cribbb\Model\Users\Password;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\entity(repositoryClass="Cribbb\Model\Users\UserRepository")
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

  /**
   * Create a new User instance
   *
   * @param Cribbb\Model\Users\Email $email
   * @param Cribbb\Model\Users\Username $username
   * @param Cribbb\Model\Users\Password $password
   * @return void
   */
  public function __construct(Email $email, Username $username, Password $password)
  {
    $this->setEmail($email);
    $this->setUsername($username);
    $this->setPassword($password);

    $this->cribbbs = new ArrayCollection();
  }

  /**
   * Get the User's id
   *
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Get the User's email address
   *
   * @return string
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Set the User's email address
   *
   * @param Cribbb\Model\Users\Email $email
   * @return void
   */
  private function setEmail(Email $email)
  {
    $this->email = $email;
  }

  /**
   * Get the User's username
   *
   * @return string
   */
  public function getUsername()
  {
    return $this->username;
  }

  /**
   * Set the User's username
   *
   * @param Cribbb\Model\Users\Username
   * @return void
   */
  private function setUsername(Username $username)
  {
    $this->username = $username;
  }

  /**
   * Get the User's password
   *
   * @return string
   */
  public function getPassword()
  {
    return $this->password;
  }

  /**
   * Set the User's password
   *
   * @param Cribbb\Model\Users\Password
   * @return void
   */
  private function setPassword(Password $password)
  {
    $this->password = $password;
  }

}
