<?php

class Relationship extends Eloquent {

  public function users()
  {
    return $this->belongsToMany('User');
  }

}