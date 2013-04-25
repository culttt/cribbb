<?php
use LaravelBook\Ardent\Ardent;

class Post extends Ardent {

    protected $guarded = array('id', 'created_at', 'updated_at');

    public static $rules = array(
      'body'    => 'required',
      'user_id' => 'required|numeric'
    );

    public static $factory = array(
      'body'    => 'text',
      'user_id' => 'factory|User',
    );

    public function user()
    {
      return $this->belongs_to('User');
    }
}