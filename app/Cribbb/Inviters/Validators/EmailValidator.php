<?php namespace Cribbb\Inviters\Validators;

use Cribbb\Validators\Validable;
use Cribbb\Validators\LaravelValidator;

class EmailValidator extends LaravelValidator implements Validable {

  /**
   * Validation rules
   *
   * @var array
   */
  protected $rules = array(
    'email' => 'required|email|unique:users,email|unique:invites,email'
  );

}
