<?php namespace Cribbb\Composer;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

  public function register()
  {
    $this->app['view.composer.side'] = $this->app->share(function($app)
    {
      new SideComposer($this->app->make('Cribbb\Entity\User\UserEntity'));
    });
  }

  public function boot()
  {
    $this->app->view->composer('partials.side', $this->app['view.composer.side']);
  }

}
