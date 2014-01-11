<?php namespace Cribbb\Service\Validation;

interface ValidableInterface {

  /**
   * With
   *
   * @param array
   * @return self
   */
  public function with(array $input);

  /**
   * Passes
   *
   * @return boolean
   */
  public function passes();

  /**
   * Errors
   *
   * @return Illuminate\Support\MessageBag
   */
  public function errors();

}
