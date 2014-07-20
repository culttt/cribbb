<?php namespace Cribbb\Cribbbs;

use Cribbb\Users\User;
use Cribbb\Cribbbs\Name\Name;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="cribbbs")
 */
class Cribbb {

  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string")
   */
  private $name;

  /**
   * @ORM\ManyToMany(targetEntity="Cribbb\Users\User", mappedBy="cribbbs")
   */
  private $users;

  /**
   * Create a new Cribbb instance
   *
   * @param Cribbb\Cribbbs\Name\Name $name
   * @return void
   */
  public function __construct(Name $name)
  {
    $this->setName($name);
    $this->users = new ArrayCollection();
  }

  /**
   * Get the Cribbb's name
   *
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set the Cribbb's name
   *
   * @param Cribbb\Cribbbs\Name\Name $name
   * @return void
   */
  public function setName(Name $name)
  {
    $this->name = $name;
  }

}
