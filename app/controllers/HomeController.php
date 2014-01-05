<?php

class HomeController extends BaseController {

  /**
   * Index
   */
  public function index()
  {
    return View::make('home.landing');
  }

}
