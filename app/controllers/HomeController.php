<?php

class HomeController extends BaseController {

  /**
   * Index
   *
   * @return View
   */
  public function index()
  {
    return View::make('home.index');
  }

}
