<?php namespace Cribbb\Registrators\Validators;

use Cribbb\Validators\Validable;
use Cribbb\Validators\LaravelValidator;

class OauthTokenValidator extends LaravelValidator implements Validable {

  /**
   * Validation rules
   *
   * @var array
   */
  protected $rules = [
    'oauth_token' => 'required',
    'oauth_token_secret' => 'required'
  ];

}
