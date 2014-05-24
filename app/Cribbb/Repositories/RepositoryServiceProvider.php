<?php namespace Cribbb\Repositories;

use Post;
use User;
use Invite;
use Cribbb;
use Cribbb\Cache\LaravelCache;
use Illuminate\Support\ServiceProvider;
use Cribbb\Repositories\User\CacheDecorator;
use Cribbb\Repositories\User\EloquentUserRepository;
use Cribbb\Repositories\Post\EloquentPostRepository;
use Cribbb\Repositories\Invite\EloquentInviteRepository;
use Cribbb\Repositories\Cribbb\EloquentCribbbRepository;

class RepositoryServiceProvider extends ServiceProvider {

  /**
   * Register
   */
  public function register()
  {
    $this->registerPostRepository();
    $this->registerUserRepository();
    $this->registerInviteRepository();
    $this->registerCribbbRepository();
  }

  /**
   * Register the User Repository
   *
   * @return void
   */
  public function registerUserRepository()
  {
    $this->app->bind('Cribbb\Repositories\User\UserRepository', function($app)
    {
      $user = new EloquentUserRepository( new User );

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
   * Register the Post Repository
   *
   * @return void
   */
  public function registerPostRepository()
  {
    $this->app->bind('Cribbb\Repositories\Post\PostRepository', function($app)
    {
      return new EloquentPostRepository( new Post );
    });
  }

  /**
   * Register the Invite Repository
   *
   * @return void
   */
  public function registerInviteRepository()
  {
    $this->app->bind('Cribbb\Repositories\Invite\InviteRepository', function($app)
    {
      return new EloquentInviteRepository( new Invite );
    });
  }

  /**
   * Register the Cribbb Repository
   *
   * @return void
   */
  public function registerCribbbRepository()
  {
    $this->app->bind('Cribbb\Repositories\Cribbb\CribbbRepository', function($app)
    {
      return new EloquentCribbbRepository( new Cribbb );
    });

}
