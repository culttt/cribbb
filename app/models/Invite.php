<?php

class Invite extends Eloquent {

  /**
   * Properties that can be mass assigned
   *
   * @var array
   */
  protected $fillable = array('email', 'referrer_id');

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
      $model->invitation_code = $model->generateCode();
      $model->referral_code   = $model->generateCode();
    });
  }

  /**
   * Generate an code
   *
   * @return string
   */
  protected function generateCode()
  {
    return bin2hex(openssl_random_pseudo_bytes(16));
  }

}
