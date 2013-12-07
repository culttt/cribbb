<?php

class Cribbb extends Eloquent {

  /**
   * Properties that can be mass assigned
   *
   * @var array
   */
  protected $fillable = array('name', 'slug');

  /**
   * Factory
   */
  public static $factory = array(
    'name' => 'text',
    'slug' => 'text'
  );

  /**
   * Define a many-to-many relationship.
   *
   * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function users()
  {
    return $this->belongsToMany('User');
  }

  /**
   * Define a one-to-many relationship.
   *
   * @return Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function posts()
  {
    return $this->hasMany('Post');
  }

}
