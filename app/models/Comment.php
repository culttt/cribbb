<?php

class Comment extends Eloquent {

  /**
   * Properties that can be mass assigned
   *
   * @var array
   */
  protected $fillable = array('body');

  /**
   * Ardent validation rules
   */
  public static $rules = array(
    'body' => 'required',
  );

  /**
   * Factory
   */
  public static $factory = array(
    'body' => 'text',
  );

  /**
   * Comment polymorphic relationship
   */
  public function commentable()
  {
    return $this->morphTo();
  }

}