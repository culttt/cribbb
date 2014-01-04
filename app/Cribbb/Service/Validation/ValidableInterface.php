<?php namespace Cribbb\Service\Validation;

interface ValidableInterface {

  /**
   * Add data to validate against
   *
   * @param array
   * @return self
   */
  public function with(array $input);

  /**
   * Test if validation passes
   *
   * @return boolean
   */
  public function passes();

  /**
   * Retrieve validation errors
   *
   * @return Illuminate\Support\MessageBag
   */
  public function errors();

}
