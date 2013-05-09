<?php

class Post extends Eloquent {

  /**
   * Properties that can be mass assigned
   *
   * @var array
   */
  protected $fillable = array('body');

  /**
   * User relationship
   */
  public function user()
  {
    return $this->belongsTo('User');
  }

}