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
    // Create new post
    $post = new Post($input);

    // Get the current user
    $user = \Auth::user();

    // Save the post
    $user->posts()->save($post);

    // Return the post
    return $post;
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