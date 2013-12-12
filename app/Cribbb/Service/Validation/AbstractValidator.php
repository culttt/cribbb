<?php namespace Cribbb\Service\Validation;

abstract class AbstractValidator implements ValidableInterface {

  /**
   * Validator
   *
   * @var object
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
   * Set data to validate
   *
   * @param array $data
   * @return self
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
  abstract function passes(array $rules);

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
