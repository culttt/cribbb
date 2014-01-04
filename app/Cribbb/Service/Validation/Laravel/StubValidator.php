<?php namespace Cribbb\Service\Validation\Laravel;

use Cribbb\Service\Validation\ValidableInterface;

class StubValidator extends LaravelValidator implements ValidableInterface {

  /**
   * Validation rules
   *
   * @var array
   */
  protected $rules = array(
    'email' => 'required|email|unique:users,email,{id}',
    'password' => 'required'
  );

}
