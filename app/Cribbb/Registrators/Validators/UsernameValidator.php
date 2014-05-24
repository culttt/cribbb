<?php namespace Cribbb\Registrators\Validators;

use Cribbb\Validators\Validable;
use Cribbb\Validators\LaravelValidator;

class UsernameValidator extends LaravelValidator implements Validable {

  /**
   * Validation rules
   *
   * @var array
   */
  protected $rules = [
    'username' => 'required|alpha_dash|name|unique:users'
  ];

}
