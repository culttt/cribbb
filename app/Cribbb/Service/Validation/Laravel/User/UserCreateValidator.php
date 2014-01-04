<?php namespace Cribbb\Service\Validation\Laravel\User;

use Cribbb\Service\Validation\ValidableInterface;
use Cribbb\Service\Validation\Laravel\LaravelValidator;

class UserCreateValidator extends LaravelValidator implements ValidableInterface {

  /**
   * Validation rules
   *
   * @var array
   */
  protected $rules = array(
    'email' => 'required|email|unique:users,email',
    'password' => 'required'
  );

}
