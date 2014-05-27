<?php namespace Cribbb\Repositories\Cribbb;

use Cribbb\Validators\Validable;
use Cribbb\Validators\LaravelValidator;

class CribbbUpdateValidator extends LaravelValidator implements Validable {

  /**
   * Validation rules
   *
   * @var array
   */
  protected $rules = [
    'name' => 'required|alpha|name|unique:cribbbs,name,{id}',
  ];

}
