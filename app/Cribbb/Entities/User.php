<?php namespace Cribbb\Entities;

use Doctrine\ORM\Mapping as ORM;
use Illuminate\Auth\UserInterface;
use Mitch\LaravelDoctrine\Traits\Timestamps;
use Mitch\LaravelDoctrine\Traits\SoftDeletes;
use Mitch\LaravelDoctrine\Traits\RememberToken;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface {

  use SoftDeletes;
  use RememberToken;
  use Timestamps;

  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  protected $id;

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
  protected $password;

  /**
   * @ORM\ManyToMany(targetEntity="Cribbb", inversedBy="users")
   */
  private $cribbbs;

  public function __construct()
  {
    $this->cribbbs = new ArrayCollection();
  }

  public function getId()
  {
    return $this->id;
  }

  public function getAuthIdentifier()
  {
    return $this->getId();
  }

  public function getAuthPassword()
  {
    return $this->getPassword();
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function setUsername($username)
  {
    $this->username = $username;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }

  public function addToCribbbs($cribbb)
  {
    $this->cribbbs[] = $cribbb;
  }

  public function getCribbbs()
  {
    return $this->cribbbs;
  }

}
