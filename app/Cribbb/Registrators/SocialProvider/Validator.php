<?php namespace Cribbb\Registrators\SocialProvider;

use Cribbb\Validators\Validable;
use Cribbb\Validators\LaravelValidator;

class Validator extends LaravelValidator implements Validable {

  /**
   * Validation rules
   *
   * @var array
   */
  protected $rules = array(
    'email'     => 'required|email|unique:users,email',
    'username'  => 'required|unique:users,username',
    'oauth_token' => 'required',
    'oauth_token_secret' => 'required'
  );

}
