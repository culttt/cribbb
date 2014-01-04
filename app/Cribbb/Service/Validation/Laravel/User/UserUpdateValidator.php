<?php namespace Cribbb\Service\Validation\Laravel\User;

use Cribbb\Service\Validation\ValidableInterface;
use Cribbb\Service\Validation\Laravel\LaravelValidator;

class UserUpdateValidator extends LaravelValidator implements ValidableInterface {

  /**
   * Validation rules
   *
   * @var array
   */
  protected $rules = array(
    'id' => 'required|exists:users,id',
    'email' => 'email|unique:users,email,{id}',
  );

}
