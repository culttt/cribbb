<?php

class Invite extends Eloquent {

  /**
   * Properties that can be mass assigned
   *
   * @var array
   */
  protected $fillable = array('code', 'email');

}
