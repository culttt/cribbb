<?php namespace Cribbb\Registrators;

interface Registrator {

  /**
   * Create a new user
   *
   * @return User
   */
  public function create(array $data);

}
