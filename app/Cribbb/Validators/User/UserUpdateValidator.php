<?php namespace Cribbb\Validators\User;

use Cribbb\Validators\Validable;
use Cribbb\Validators\LaravelValidator;

class UserUpdateValidator extends LaravelValidator implements Validable {

  /**
   * Validation rules
   *
   * @var array
   */
  protected $rules = array(
    'id'    => 'required|exists:users,id',
    'email' => 'required|email|unique:users,email,{id}',
  );

}
