<?php

class RegisterController extends BaseController {

  /**
   * Create a new instance of the RegisterController
   *
   * @return void
   */
  public function __construct()
  {
    $this->beforeFilter('invite');
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

  }

}
