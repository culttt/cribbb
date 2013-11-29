<?php

use Magniloquent\Magniloquent\Magniloquent;

class Cribbb extends Magniloquent {

  /**
   * Properties that can be mass assigned
   *
   * @var array
   */
  protected $fillable = array('name', 'slug');

  /**
   * Validation rules
   */
  public static $rules = array(
    "save" => array(
      'name' => 'required'
    ),
    "create" => array(
      'name' => 'unique:cribbbs'
    ),
    "update" => array()
  );

  /**
   * User relationship
   */
  public function users()
  {
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
