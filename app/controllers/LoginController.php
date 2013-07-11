<?php

use Cribbb\Storage\User\UserRepository as User;

class LoginController extends BaseController {

  /**
   * User Repository
   */
  protected $user;

  /**
   * Inject the User Repository
   */
  public function __construct(User $user)
  {
    $this->user = $user;
  }

  public function index()
  {
    return View::make('login.index');
  }

  public function attempt()
  {
    if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'))))
    {
      return Auth::user()->email;
    }
  }

}