<?php namespace Cribbb\Repository;

use User;
use Post;
use Cribbb\Repository\User\EloquentUser;
use Cribbb\Repository\User\EloquentPost;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

  public function register()
  {
    $app = $this->app;

    /**
     * User Model
     *
     * @return EloquentUser
     */
    $this->app->bind('Cribbb\Repository\User\UserRepository', function($app)
    {
      $user = new EloquentUser(
        new User,
        $app->make('Cribbb\Repository\Post\PostRepository')
      );

      return $user;
    });

    /**
     * Post Model
     *
     * @return EloquentPost
     */
    $this->app->bind('Cribbb\Repository\Post\PostRepository', function($app)
    {
      $post = new EloquentPost(new Post);

      return $post;
    });

  }

}
