<?php

class Clique extends Eloquent {

  /**
   * Factory
   */
  public static $factory = array(
    'name' => 'string'
  );

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