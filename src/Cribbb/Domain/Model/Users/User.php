<?php namespace Cribbb\Domain\Model\Users;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\entity(repositoryClass="Cribbb\Domain\Model\Users\UserRepository")
 */
class User {

  /**
   * @ORM\Column(type="string")
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
   * Create a new User
   *
   * @param UserId $userId
   * @param Email $email
   * @param Username $username
   * @param Password $password
   * @return void
   */
  private function __construct(UserId $userId, Email $email, Username $username, Password $password)
  {
    $this->setId($userId);
    $this->setEmail($email);
    $this->setUsername($username);
    $this->setPassword($password);

    $this->cribbbs = new ArrayCollection();
  }

  /**
   * Register a new User
   *
   * @param UserId $userId
   * @param Email $email
   * @param Username $username
   * @param Password $password
   * @return User
   */
  public static function register(UserId $userId, Email $email, Username $username, Password $password)
  {
    return new User($userId, $email, $username, $password);
  }

  /**
   * Get the User's id
   *
   * @return UserId;
   */
  public function id()
  {
    return UserId::fromString($this->id);
  }

  /**
   * Set the User's id
   *
   * @param UserId $userId
   * @return void
   */
  private function setId(UserId $userId)
  {
    $this->id = (string) $userId;
  }

  /**
   * Get the User's email address
   *
   * @return string
   */
  public function email()
  {
    return $this->email;
  }

  /**
   * Set the User's email address
   *
   * @param Email $email
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
  public function username()
  {
    return $this->username;
  }

  /**
   * Set the User's username
   *
   * @param Username
   * @return void
   */
  private function setUsername(Username $username)
  {
    $this->username = $username;
  }

  /**
   * Set the User's password
   *
   * @param Password
   * @return void
   */
  private function setPassword(Password $password)
  {
    $this->password = $password;
  }

}
