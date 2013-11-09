<?php

use Cribbb\Storage\User\UserRepository as User;

class HomeController extends BaseController {

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
    if (Auth::check())
    {
      $user = Auth::user();

      $posts = $this->user->feed();

      return View::make('home.dashboard', compact('user', 'posts'));
    }
    return View::make('home.landing');
  }

}
