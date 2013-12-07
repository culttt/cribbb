<?php namespace Cribbb\Service\Validation;

use Illuminate\Validation\Factory;

abstract class AbstractLaravelValidator implements ValidableInterface {

  /**
   * Validator
   *
   * @var \Illuminate\Validation\Factory
   */
    protected $validator;

  /**
   * Validation data key => value array
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
   * Validation rules
   *
   * @var Array
   */
  protected $rules = array();

  /**
   * Construct
   *
   * @param \Illuminate\Validation\Factory $validator
   */
  public function __construct(Factory $validator)
  {
    $this->validator = $validator;
  }

  /**
   * Set data to validate
   *
   * @param array $data
   * @return \Cribbb\Service\Validation\AbstractLaravelValidator
   */
    public function with(array $data)
    {
      $this->data = $data;

      return $this;
    }

  /**
   * Validation passes or fails
   *
   * @return boolean
   */
  public function passes()
  {
    $validator = $this->validator->make($this->data, $this->rules);

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
