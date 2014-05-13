<?php namespace Cribbb\Registrators\Validators;

use Cribbb\Validators\Validable;
use Cribbb\Validators\LaravelValidator;

class UidValidator extends LaravelValidator implements Validable {

  /**
   * Validation rules
   *
   * @var array
   */
  protected $rules = [
    'uid' => 'required|unique:users',
  ];

}
