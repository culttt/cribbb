<?php

class HomeController extends BaseController {

  /**
   * Controller layout
   *
   * @var string
   */
  protected $layout = 'layouts.application';

  /**
   * Create a new instance of the HomeController
   *
   * @return void
   */
  public function __construct()
  {
    $this->beforeFilter('auth', ['except' => 'index']);
  }

  /**
   * Index
   *
   * @return View
   */
  public function index()
  {
    if(Auth::guest())
    {
      return $this->website();
    }

    $this->layout->nest('content', 'application.dashboard');
  }

  /**
   * Return the static website home page
   *
   * @return View
   */
  public function website()
  {
    if(Input::has('referral'))
    {
      Session::put('referral_code', Input::get('referral'));
    }

    $layout = View::make('layouts.website');

    return $layout->nest('content', 'website.index');
  }

}
