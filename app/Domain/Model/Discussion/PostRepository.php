<?php namespace Cribbb\Domain\Model\Discussion;

interface PostRepository
{
    /**
     * Find a post by its id
     *
     * @param PostId $id
     * @return Post
     */
    public function postOfId(PostId $id);

    /**
     * Add a new Post
     *
     * @param Post $post
     * @return void
     */
    public function add(Post $post);
}