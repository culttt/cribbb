<?php

class Comment extends Eloquent {

  /**
   * Properties that can be mass assigned
   *
   * @var array
   */
  protected $fillable = array('body');

  /**
   * Factory
   *
   * @var array
   */
  public static $factory = array(
    'body' => 'text',
  );

  /**
   * Define a polymorphic relationship
   *
   * @return
   */
  public function commentable()
  {
    return $this->morphTo();
  }

}
