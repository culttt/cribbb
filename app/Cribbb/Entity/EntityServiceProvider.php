<?php namespace Cribbb\Entity;

use Illuminate\Validation\Factory;
use Illuminate\Support\ServiceProvider;
use Cribbb\Entity\User\UserEntity;
use Cribbb\Service\Validation\Laravel\User\UserCreateValidator;
use Cribbb\Service\Validation\Laravel\User\UserUpdateValidator;

class EntityServiceProvider extends ServiceProvider {

  /**
   * Register the binding
   *
   * @return void
   */
  public function register()
  {
    /**
     * User Entity
     *
     * @return Cribbb\Entity\User\UserEntity
     */
    $this->app->bind('Cribbb\Entity\User\UserEntity', function($app)
    {
      return new UserEntity(
        $app->make('Cribbb\Repository\User\UserRepository'),
        new UserCreateValidator( $app['validator'] ),
        new UserUpdateValidator( $app['validator'] )
      );
    });
  }

}
