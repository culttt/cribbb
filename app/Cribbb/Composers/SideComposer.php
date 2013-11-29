<?php namespace Cribbb\Composers;

use Auth;

class SideComposer {

  public function compose($view)
  {
    $view->with('user', Auth::user());
    $view->with('cribbbs', array('first', 'second', 'third'));
  }

}
