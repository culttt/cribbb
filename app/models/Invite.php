<?php

class Invite extends Eloquent {

  /**
   * Properties that can be mass assigned
   *
   * @var array
   */
  protected $fillable = array('email');

  /**
   * Register the model events
   *
   * @return void
   */
  protected static function boot()
  {
    parent::boot();

    static::creating(function($model)
    {
      $model->generateInvitationCode();
    });
  }

  /**
   * Generate an invitation code
   *
   * @return void
   */
  protected function generateInvitationCode()
  {
    $this->code = bin2hex(openssl_random_pseudo_bytes(16));
  }

}
