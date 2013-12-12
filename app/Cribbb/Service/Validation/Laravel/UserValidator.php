<?php namespace Cribbb\Service\Validation\Laravel;

use Cribbb\Service\Validation\ValidableInterface;

class UserValidator extends LaravelValidator implements ValidableInterface {

  /**
   * Validation for creating a new User
   *
   * @var array
   */
  protected $createRules = array(
    'username' => 'required|min:2',
    'email' => 'required|email',
    'password' => 'required'
  );

  /**
   * Validation for updating a new User
   *
   * @var array
   */
  protected $updateRules = array(
    'username' => 'required|min:2',
    'email' => 'required|email',
    'password' => 'required'
  );

}
