<?php namespace Cribbb\Validators\User;

use Cribbb\Validators\Validable;
use Cribbb\Validators\LaravelValidator;

class UserCreateValidator extends LaravelValidator implements Validable {

  /**
   * Validation rules
   *
   * @var array
   */
  protected $rules = array(
    'email'     => 'required|email|unique:users,email',
    'password'  => 'required'
  );

}
