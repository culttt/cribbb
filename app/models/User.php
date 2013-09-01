<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Magniloquent\Magniloquent\Magniloquent;

class User extends Magniloquent implements UserInterface, RemindableInterface {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'users';

  /**
   * Properties that can be mass assigned
   *
   * @var array
   */
  protected $fillable = array('username', 'first_name', 'last_name', 'email', "password", "password_confirmation");

  /**
   * Post relationship
   */
  public function posts()
  {
    return $this->hasMany('Post');
  }

  /**
   * User following relationship
   */
  public function follow()
  {
    return $this->belongsToMany('User', 'user_follows', 'user_id', 'follow_id');
  }

  /**
   * User followers relationship
   */
  public function followers()
  {
    return $this->belongsToMany('User', 'user_follows', 'follow_id', 'user_id');
  }

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = array('password');

  /**
   * Validation rules
   */
  public static $rules = array(
    "save" => array(
      'username' => 'required|min:4',
      'email' => 'required|email',
      'password' => 'required'
    ),
    "create" => array(
      'username' => 'unique:users',
      'email' => 'unique:users',
      'password' => 'confirmed',
      'password_confirmation' => 'required'
    ),
    "update" => array()
  );

  /**
   * Factory
   */
  public static $factory = array(
    'username' => 'string',
    'email' => 'email',
    'password' => 'password',
    'password_confirmation' => 'password'
  );

  public function feed()
  {
    $id = $this->id;

   return Post::whereIn('user_id', function($query) use ($id)
          {
            $query->select('follow_id')
                  ->from('user_follows')
                  ->where('user_id', $id);
          })->orWhere('user_id', $id)->get();
  }

  /**
   * Auto purge redundant attributes
   *
   * @var bool
   */
  public $autoPurgeRedundantAttributes = true;

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