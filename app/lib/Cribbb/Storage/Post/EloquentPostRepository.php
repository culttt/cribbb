<?php namespace Cribbb\Storage\Post;

use Post;

class EloquentPostRepository implements PostRepository {

  public function all()
  {
    return Post::all();
  }

  public function find($id)
  {
    return Post::find($id);
  }

  public function create($input)
  {
    return Post::create($input);
  }

  public function update($id)
  {
    $post = $this->find($id);

    $post->save(\Input::all());

    return $post;
  }

  public function delete($id)
  {
    $post = $this->find($id);

    return $post->delete();
  }

}