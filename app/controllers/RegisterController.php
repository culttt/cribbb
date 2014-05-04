<?php

use Cribbb\Registrators\CredentialsRegistrator;

class RegisterController extends BaseController {

  /**
   * Create a new instance of the RegisterController
   *
   * @return void
   */
  public function __construct(CredentialsRegistrator $registrator)
  {
    $this->beforeFilter('invite');
    $this->registrator = $registrator;
  }

  /**
   * Display the form for creating a new user
   *
   * @return View
   */
  public function index()
  {
    return View::make('register.index');
  }

  /**
   * Create a new user
   *
   * @return Redirect
   */
  public function store()
  {
    $user = $this->registrator->create(Input::all());

    echo "<pre>";
    dd($user);
  }

}
