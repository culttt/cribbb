<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

  /**
   * Properties that can be mass assigned
   *
   * @var array
   */
  protected $fillable = array(
    'username',
    'first_name',
    'last_name',
    'email',
    'password',
    'oauth_token',
    'oauth_token_secret'
  );

  /**
   * Define a many-to-many relationship.
   *
   * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function cribbbs()
  {
    return $this->belongsToMany('Cribbb');
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

  /**
   * Define a many-to-many relationship.
   *
   * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function follow()
  {
    return $this->belongsToMany('User', 'user_follows', 'user_id', 'follow_id')->withTimestamps();
  }

  /**
   * Define a many-to-many relationship.
   *
   * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function followers()
  {
    return $this->belongsToMany('User', 'user_follows', 'follow_id', 'user_id')->withTimestamps();
  }

  /**
   * Get the unique identifier for the user.
   *
   * @return mixed
   */
  public function getAuthIdentifier()
  {
    return $this->getKey();
  }

  /**
   * Get the password for the user.
   *
   * @return string
   */
  public function getAuthPassword()
  {
    return $this->password;
  }

  /**
   * Get the e-mail address where password reminders are sent.
   *
   * @return string
   */
  public function getReminderEmail()
  {
    return $this->email;
  }

}
