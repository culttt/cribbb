<?php

use Cribbb\Storage\Post\PostRepository as Post;

class HomeController extends BaseController {

  /**
   * Post Repository
   */
  protected $post;

  /**
   * Inject the User Repository
   */
  public function __construct(Post $post)
  {
    $this->post = $post;
  }

  public function index()
  {
    if (Auth::check())
    {
      $posts = $this->post->all();

      return View::make('home.dashboard', compact('posts'));
    }
    return View::make('home.landing');
  }

}