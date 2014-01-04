<?php namespace Cribbb\Repository;

use User;
use Post;
use Illuminate\Support\ServiceProvider;
use Cribbb\Repository\User\EloquentUserRepository;
use Cribbb\Repository\Post\EloquentPostRepository;

class RepositoryServiceProvider extends ServiceProvider {

  public function register()
  {
    /**
     * User Repository
     *
     * @return Cribbb\Repository\User\EloquentUserRepository
     */
    $this->app->bind('Cribbb\Repository\User\UserRepository', function($app)
    {
      return new EloquentUserRepository(
        new User,
        $app->make('Cribbb\Repository\Post\PostRepository')
      );
    });

    /**
     * Post Repository
     *
     * @return Cribbb\Repository\Post\EloquentPostRepository
     */
    $this->app->bind('Cribbb\Repository\Post\PostRepository', function($app)
    {
      return new EloquentPostRepository( new Post );
    });
  }

}
