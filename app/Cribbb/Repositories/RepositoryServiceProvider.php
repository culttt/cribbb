<?php namespace Cribbb\Repositories;

use Post;
use User;
use Invite;
use Cribbb\Cache\LaravelCache;
use Illuminate\Support\ServiceProvider;
use Cribbb\Repositories\User\CacheDecorator;
use Cribbb\Repositories\User\EloquentUserRepository;
use Cribbb\Repositories\Post\EloquentPostRepository;
use Cribbb\Repositories\Invite\EloquentInviteRepository;

class RepositoryServiceProvider extends ServiceProvider {

  /**
   * Register
   */
  public function register()
  {
    $this->registerPostRepository();
    $this->registerUserRepository();
    $this->registerInviteRepository();
  }

  /**
   * Register User Repository
   */
  public function registerUserRepository()
  {
    $this->app->bind('Cribbb\Repositories\User\UserRepository', function($app)
    {
      $user = new EloquentUserRepository( new User, $app['hash'] );

      $user->registerValidator(
        'create', $this->app->make('Cribbb\Validators\User\UserCreateValidator')
      );

      $user->registerValidator(
        'update', $this->app->make('Cribbb\Validators\User\UserUpdateValidator')
      );

      return new CacheDecorator( $user, new LaravelCache( $app['cache'], 'user') );
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

  /**
   * Register Invite Repository
   */
  public function registerInviteRepository()
  {
    $this->app->bind('Cribbb\Repositories\Invite\InviteRepository', function($app)
    {
      return new EloquentInviteRepository( new Invite );
    });
  }

}
