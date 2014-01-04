<?php namespace Cribbb\Service\Validation;

class StubValidator extends AbstractValidator implements ValidableInterface {

  /**
   * Passes
   *
   * @return boolean
   */
  public function passes()
  {
    return true;
  }

}
