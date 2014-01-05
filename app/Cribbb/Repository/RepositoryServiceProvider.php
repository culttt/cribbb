<?php namespace Cribbb\Repository;

use User;
use Post;
use Cribbb\Service\Cache\LaravelCache;
use Illuminate\Support\ServiceProvider;
use Cribbb\Repository\User\CacheDecorator;
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
      $user = new EloquentUserRepository(
        new User,
        $app->make('Cribbb\Repository\Post\PostRepository')
      );

      return new CacheDecorator(
        $user,
        new LaravelCache($app['cache'], 'user')
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
