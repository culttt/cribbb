<?php namespace Cribbb\Service\Validation\Laravel;

use Cribbb\Service\Validation\ValidableInterface;

class StubValidator extends LaravelValidator implements ValidableInterface {

  /**
   * Validation for creating a new User
   *
   * @var array
   */
  protected $createRules = array(
    'username' => 'required|alpha_dash|min:2',
    'email' => 'required|email',
    'password' => 'required|confirmed'
  );

  /**
   * Validation for updating a new User
   *
   * @var array
   */
  protected $updateRules = array(
    'username' => 'required|alpha_dash|min:2',
    'email' => 'required|email',
    'password' => 'required'
  );

}
