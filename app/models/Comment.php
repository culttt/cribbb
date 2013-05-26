<?php

class Comment extends Eloquent {

  public function commentable()
  {
    return $this->morphTo();
  }

}