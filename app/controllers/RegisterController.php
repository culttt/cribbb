<?php

class RegisterController extends BaseController {

  /**
   * Create a new instance of the RegisterController
   *
   * @return void
   */
  public function __construct()
  {
    $this->beforeFilter('invite', array('only' => 'index'));
  }

  /**
   * Display the form for creating a new user
   *
   * @return View
   */
  public function index()
  {
    return 'Sign up here';
  }

}
