<?php namespace Cribbb\Validators;

interface Validable {

  /**
   * Pass the data to the validator
   *
   * @param array
   * @return self
   */
  public function with(array $data);

  /**
   * Determine if the data passes the validation rules
   *
   * @return boolean
   */
  public function passes();

  /**
   * Return the errors
   *
   * @return Illuminate\Support\MessageBag
   */
  public function errors();

}
