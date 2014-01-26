<?php namespace Cribbb\Composer;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

  /**
   * Register the binding
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('Cribbb\Composer\SideComposer', function($app)
    {
      new SideComposer($this->app->make('Cribbb\Entity\User\UserEntity'));
    });
  }

  /**
   * Bootstrap the application events.
   *
   * @return void
   */
  public function boot()
  {
    $this->app->view->composer('partials.side', $this->app->make('Cribbb\Composer\SideComposer'));
  }

}

