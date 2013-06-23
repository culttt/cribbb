<?php

use Magniloquent\Magniloquent\Magniloquent;

class Post extends Magniloquent {

  /**
   * Properties that can be mass assigned
   *
   * @var array
   */
  protected $fillable = array('body');

  /**
   * Validation rules
   */
  public static $rules = array(
    "save" => array(
      'body' => 'required',
      'user_id' => 'required|numeric',
    ),
    "create" => array(),
    "update" => array()
  );

  /**
   * Factory
   */
  public static $factory = array(
    'body' => 'text',
    'user_id' => 'factory|User',
  );

  /**
   * User relationship
   */
  public function user()
  {
    return $this->belongsTo('User');
  }

  /**
   * Comment relationship
   */
  public function comments()
  {
    return $this->morphMany('Comment', 'commentable');
  }

}