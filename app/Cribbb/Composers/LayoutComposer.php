<?php namespace Cribbb\Composers;

class LayoutComposer {

  public function compose($view)
  {
    $view->with('cribbbs', array('first', 'second', 'third'));
  }

}
