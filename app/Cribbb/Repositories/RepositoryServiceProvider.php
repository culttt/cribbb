<?php namespace Cribbb\Repositories;

use Post;
use User;
use Cribbb\Cache\LaravelCache;
use Illuminate\Support\ServiceProvider;
use Cribbb\Repositories\User\CacheDecorator;
use Cribbb\Repositories\User\EloquentUserRepository;
use Cribbb\Repositories\Post\EloquentPostRepository;

class RepositoryServiceProvider extends ServiceProvider {

  /**
   * Register
   */
  public function register()
  {
    $this->registerPostRepository();
    $this->registerUserRepository();
  }

  /**
   * Register User Repository
   */
  public function registerUserRepository()
  {
    $this->app->bind('Cribbb\Repositories\User\UserRepository', function($app)
    {
      $user = new EloquentUserRepository(
        new User,
        $app->make('Cribbb\Repositories\Post\PostRepository')
      );

      $user->registerValidator(
        'create', $this->app->make('Cribbb\Validators\User\UserCreateValidator')
      );

      $user->registerValidator(
        'update', $this->app->make('Cribbb\Validators\User\UserUpdateValidator')
      );

      return new CacheDecorator(
        $user,
        new LaravelCache($app['cache'], 'user')
      );
    });

  }

  /**
   * Register Post Repository
   */
  public function registerPostRepository()
  {
    $this->app->bind('Cribbb\Repositories\Post\PostRepository', function($app)
    {
      return new EloquentPostRepository( new Post );
    });
  }

}
