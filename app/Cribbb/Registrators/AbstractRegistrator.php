<?php namespace Cribbb\Registrators;

use Exception;
use Cribbb\Validators\Validable;
use Illuminate\Support\MessageBag;

abstract class AbstractRegistrator {

  /**
   * The errors MesssageBag instance
   *
   * @var Illuminate\Support\MessageBag
   */
  protected $errors;

  /**
   * Create a new instance of Illuminate\Support\MessageBag
   * automatically when the child class is created
   *
   * @return void
   */
  public function __construct()
  {
    $this->errors = new MessageBag;
  }

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
   * Return the errors MessageBag
   *
   * @return Illuminate\Support\MessageBag
   */
  public function errors()
  {
    return $this->errors;
  }

}
