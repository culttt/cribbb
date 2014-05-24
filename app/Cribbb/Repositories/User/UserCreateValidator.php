<?php namespace Cribbb\Repositories\User;

use Cribbb\Validators\Validable;
use Cribbb\Validators\LaravelValidator;

class UserCreateValidator extends LaravelValidator implements Validable {

  /**
   * Validation rules
   *
   * @var array
   */
  protected $rules = [
    'email'     => 'required|email|unique:users,email',
    'password'  => 'required'
  ];

}
