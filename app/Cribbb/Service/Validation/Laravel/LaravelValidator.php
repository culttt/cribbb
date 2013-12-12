<?php namespace Cribbb\Service\Validation\Laravel;

use Illuminate\Validation\Factory;
use Cribbb\Service\Validation\ValidableInterface;
use Cribbb\Service\Validation\AbstractValidator;

abstract class LaravelValidator extends AbstractValidator implements ValidableInterface {

  /**
   * Validator
   *
   * @var Illuminate\Validation\Factory
   */
  protected $validator;

  /**
   * Data to be validated
   *
   * @var array
   */
  protected $data = array();

  /**
   * Validation errors
   *
   * @var array
   */
  protected $errors = array();

  /**
   * Create Rules
   *
   * @var array
   */
  protected $createRules = array();

  /**
   * Update Rules
   *
   * @var array
   */
  protected $updateRules = array();

  /**
   * Construct
   *
   * @param Illuminate\Validation\Factory $validator
   */
  public function __construct(Factory $validator)
  {
    $this->validator = $validator;
  }

  /**
   * Set data to validate
   *
   * @param array $data
   * @return Cribbb\Service\Validation\Laravel\AbstractValidator
   */
  public function with(array $data)
  {
    $this->data = $data;

    return $this;
  }

  /**
   * Verify if the data passes the on create rules
   *
   * @return boolean
   */
  public function canCreate()
  {
    return $this->passes($this->createRules);
  }

  /**
   * Verify if the data passes the on update rules
   *
   * @return boolean
   */
  public function canUpdate()
  {
    return $this->passes($this->updateRules);
  }

  /**
   * Pass the data and the rules to the validator
   *
   * @return boolean
   */
  public function passes(array $rules)
  {
    $validator = $this->validator->make($this->data, $rules);

    if( $validator->fails() )
    {
      $this->errors = $validator->messages();
      return false;
    }

    return true;
  }

  /**
   * Return errors
   *
   * @return array
   */
  public function errors()
  {
    return $this->errors;
  }

}
