<?php

class Post extends Eloquent {

    protected $guarded = array('id', 'created_at', 'updated_at');

    public static $rules = array(
      'body' => 'required',
    );

    public function user()
    {
      return $this->belongs_to('User');
    }
}