<?php namespace Cribbb\Registrators;

class CredentialsRegistrator extends AbstractRegistrator implements Registrator {

  /**
   * An array of Validable classes
   *
   * @param array
   */
  protected $validators;

  /**
   * Create a new instance of the CredentialsRegistrator
   *
   * @return void
   */
  public function __construct(array $validators)
  {
    parent::__constuct();

    $this->validators = $validations;
  }

  /**
   * Create a new user entity
   *
   * @param array $data
   * @return Illuminate\Database\Eloquent\Model
   */
  public function create(array $data)
  {
    // Create
  }

}
