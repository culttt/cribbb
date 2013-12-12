<?php namespace Cribbb\Service\Validation;

interface ValidableInterface {

  /**
   * Add data to validation against
   *
   * @param array
   * @return self
   */
  public function with(array $input);

  /**
   * Verify if the data passes the on create rules
   *
   * @return boolean
   */
  public function canCreate();

  /**
   * Verify if the data passes the on update rules
   *
   * @return boolean
   */
  public function canUpdate();

  /**
   * Test if validation passes
   *
   * @param array $rules
   * @return boolean
   */
  public function passes(array $rules);

  /**
   * Retrieve validation errors
   *
   * @return array
   */
  public function errors();

}
