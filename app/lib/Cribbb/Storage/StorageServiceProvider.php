<?php namespace Cribbb\Storage;

use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider {

  public function register()
  {
    $this->app->bind(
      'Cribbb\Storage\User\UserRepository',
      'Cribbb\Storage\User\EloquentUserRepository'
    );
    $this->app->bind(
      'Cribbb\Storage\Post\PostRepository',
      'Cribbb\Storage\Post\EloquentPostRepository'
    );
  }

}