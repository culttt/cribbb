<?php

use LaravelBook\Ardent\Ardent;

class Clique extends Ardent {

  /**
   * Properties that can be mass assigned
   *
   * @var array
   */
  protected $fillable = array('name');

  /**
   * Ardent validation rules
   */
  public static $rules = array(
    'name' => 'required',
  );

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