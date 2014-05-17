<?php

class BaseController extends Controller {

  /**
   * Controller layout
   *
   * @var string
   */
  protected $layout = 'layouts.website';

  /**
   * Setup the layout used by the controller.
   *
   * @return void
   */
  protected function setupLayout()
  {
    if ( ! is_null($this->layout))
    {
      $this->layout = View::make($this->layout);
    }
  }

}
