<?php namespace Cribbb\Composers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

  public function register()
  {
    $this->app->view->composer('partials.side', 'Cribbb\Composers\LayoutComposer');
  }

}
