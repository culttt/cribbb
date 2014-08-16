<?php namespace Cribbb\Cribbbs\Name;

use DomainException;

class Name {

  /**
   * @var string
   */
  private $name;

  /**
   * Create a new Cribbb Name
   *
   * @param string $name
   * @return void
   */
  public function __construct($name)
  {
    if( ! preg_match('/^[\pL\pM\pN_-]+$/u', $name))
    {
      throw new DomainException;
    }

    $this->name = $name;
  }

  /**
   * Return the object as a string
   *
   * @return string
   */
  public function __toString()
  {
    return $this->name;
  }

}
