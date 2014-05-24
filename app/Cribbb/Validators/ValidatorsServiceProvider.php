<?php namespace Cribbb\Validators;

use Illuminate\Support\ServiceProvider;

class ValidatorsServiceProvider extends ServiceProvider {

  /**
   * Register
   *
   * @return void
   */
  public function register(){}

  /**
   * Boot
   *
   * @return void
   */
  public function boot()
  {
    $this->app->validator->resolver(function($translator, $data, $rules, $messages)
    {
      return new NameValidator($translator, $data, $rules, $messages);
    });
  }

}
