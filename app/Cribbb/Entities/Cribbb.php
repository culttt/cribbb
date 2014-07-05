<?php namespace Cribbb\Entities;

use Doctrine\ORM\Mapping as ORM;
use Mitch\LaravelDoctrine\Traits\Timestamps;
use Mitch\LaravelDoctrine\Traits\SoftDeletes;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="cribbbs")
 */
class Cribbb {

  use SoftDeletes;
  use Timestamps;

  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  protected $id;

  /**
   * @ORM\ManyToMany(targetEntity="User", mappedBy="cribbbs")
   */
  protected $users;

  public function __construct()
  {
    $this->users = new ArrayCollection();
  }

  public function getId()
  {
    return $this->id;
  }

}
