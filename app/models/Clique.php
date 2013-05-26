<?php

class Clique extends Eloquent {

  /**
   * User relationship
   */
  public function user(){
    return $this->belongsToMany('User');
  }

  /**
   * Post relationship
   */
  public function posts()
  {
    return $this->hasMany('Post');
  }
}