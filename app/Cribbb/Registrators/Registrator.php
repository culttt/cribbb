<?php namespace Cribbb\Registrators;

interface Registrator {

  /**
   * Create a new user entity
   *
   * @param array $data
   * @return Illuminate\Database\Eloquent\Model
   */
  public function create(array $data);

}
