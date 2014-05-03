<?php namespace Cribbb\Registrators;

use Illuminate\Support\MessageBag;

abstract class AbstractRegistrator {

  /**
   * The MessageBag instance
   *
   * @var Illuminate\Support\MessageBag
   */
  protected $errors;

  /**
   * Set the empty MessageBag instance on instantiation
   *
   * @return void
   */
  public function __construct()
  {
    $this->errors = new MessageBag;
  }

  /**
   * Return the errors
   *
   * @return Illuminate\Support\MessageBag
   */
  public function errors()
  {
    return $this->errors;
  }

}
