<?php namespace Cribbb\Service\Form\Article;

use Cribbb\Service\Validation\AbstractLaravelValidator;

class UserFormLaravelValidator extends AbstractLaravelValidator {

  /**
   * Validation rules
   *
   * @var Array
   */
  protected $rules = array(
    'username' => 'required|min:2',
    'email' => 'required|email',
    'password' => 'required'
  );

}
