<?php

class Post extends Eloquent {

  /**
   * Properties that can be mass assigned
   *
   * @var array
   */
  protected $fillable = array('body');

  /**
   * Factory
   */
  public static $factory = array(
    'body' => 'text',
    'user_id' => 'factory|User',
    'cribbb_id' => 'factory|Cribbb'
  );

  /**
   * Define a one-to-one relationship.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user()
  {
    return $this->belongsTo('User');
  }

  /**
   * Define a one-to-many relationship.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function cribbb()
  {
    return $this->belongsTo('Cribbb');
  }

  /**
   * Define a polymorphic relationship
   *
   * @return
   */
  public function comments()
  {
    return $this->morphMany('Comment', 'commentable');
  }

}
