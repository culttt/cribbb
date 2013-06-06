<?php

class Post extends Eloquent {

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
    'body' => 'required',
    'user_id' => 'required|numeric',
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