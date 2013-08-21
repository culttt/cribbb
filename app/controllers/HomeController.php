<?php

class HomeController extends BaseController {

  public function index()
  {
    if (Auth::check())
    {
      $posts = Post::all();

      return View::make('home.dashboard', compact('posts'));
    }
    return View::make('home.landing');
  }

}