<?php namespace Cribbb\Validators;

use Illuminate\Validation\Validator;

class NameValidator extends Validator {

  /**
   * An array of reserved names
   *
   * @var array
   */
  protected $reserved = ['admin', 'cribbbs'];

  /**
   * Validate a name against an array of reserved names
   *
   * @param string $attribute
   * @param string $value
   * @param array $parameters
   * @return bool
   */
  public function validateName($attribute, $value, $parameters)
  {
    if(in_array($value, $this->reserved))
    {
      return false;
    }

    return true;
  }
}
