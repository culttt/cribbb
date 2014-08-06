<?php namespace Cribbb\Domain\Users;

use Doctrine\ORM\Mapping as ORM;
use Cribbb\Domain\Cribbbs\Cribbb;
use Cribbb\Domain\Users\Email\Email;
use Cribbb\Domain\Users\Username\Username;
use Cribbb\Domain\Users\Password\Password;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\entity(repositoryClass="Cribbb\Domain\Users\UserRepository")
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
   * @ORM\ManyToMany(targetEntity="Cribbb\Domain\Cribbbs\Cribbb", mappedBy="users")
   */
  private $cribbbs;

  /**
   * Create a new User instance
   *
   * @param Cribbb\Domain\Users\Email\Email $email
   * @param Cribbb\Domain\Users\Username\Username $username
   * @param Cribbb\Domain\Users\Password\Password $password
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
   * @param Cribbb\Domain\Users\Email\Email $email
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
   * @param Cribbb\Domain\Users\Username\Username
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
   * @param Cribbb\Domain\Users\Password\Password
   * @return void
   */
  private function setPassword(Password $password)
  {
    $this->password = $password;
  }

  /**
   * Add the user to a Cribbb
   *
   * @param Cribbb\Domain\Cribbbs\Cribbb $cribbb
   * @return void
   */
  public function addToCribbb(Cribbb $cribbb)
  {
    $cribbb->addUser($this);

    $this->cribbbs[] = $cribbb;
  }

}
