<?php

class HomeController extends BaseController {

  public function index()
  {
    if (Auth::check())
    {
      return View::make('home.dashboard');
    }
    return View::make('home.landing');
  }

}