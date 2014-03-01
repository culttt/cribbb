<?php namespace Cribbb\Presenters;

class UserPresenter extends AbstractPresenter implements Presentable {

  /**
   * Present the created_at property
   * using a different format
   *
   * @return string
   */
  public function created_at()
  {
    return $this->object->created_at->format('Y-m-d');
  }

}
