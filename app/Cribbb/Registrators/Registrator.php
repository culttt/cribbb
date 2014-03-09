<?php namespace Cribbb\Registrators;

interface Registrator {

  /**
   * Create a new user
   *
   * @return User
   */
  public function create(array $data);

  /**
   * Return the errors
   *
   * @return Illuminate\Support\MessageBag
   */
  public function errors();

}
