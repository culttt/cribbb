<?php namespace Cribbb\Registrators\Validators;

use Cribbb\Validators\Validable;
use Cribbb\Validators\LaravelValidator;

class EmailValidator extends LaravelValidator implements Validable {

  /**
   * Validation rules
   *
   * @var array
   */
  protected $rules = [
    'email' => 'required|email|unique:users'
  ];

}
