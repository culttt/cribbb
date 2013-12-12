<?php namespace Cribbb\Composer;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

  public function register()
  {
    $this->app->view->composer('partials.side', 'Cribbb\Composer\SideComposer');
  }

}
