<?php namespace Cribbb\Inviters;

use Exception;
use Cribbb\Validators\Validable;

abstract class AbstractInviter {

  /**
   * Run the validation checks on the input data
   *
   * @param array $data
   * @return bool
   */
  public function runValidationChecks(array $data)
  {
    foreach($this->validators as $validator)
    {
      if($validator instanceof Validable)
      {
        if(! $validator->with($data)->passes())
        {
          $this->errors->merge($validator->errors());
        }
      }

      else
      {
        throw new Exception("{$validator} is not an instance of Cribbb\Validiators\Validable");
      }
    }

    if($this->errors->isEmpty())
    {
      return true;
    }
  }

  /**
   * Return the errors message bag
   *
   * @return Illuminate\Support\MessageBag
   */
  public function errors()
  {
    return $this->errors;
  }

}
