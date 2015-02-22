<?php namespace Cribbb\Application\Discussion;

use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Discussion\ThreadId;
use Cribbb\Domain\Model\ValueNotFoundException;
use Cribbb\Domain\Model\Identity\UserRepository;
use Cribbb\Domain\Model\Discussion\PostRepository;
use Cribbb\Domain\Model\Discussion\ThreadRepository;

class NewPost
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var ThreadRepository
     */
    private $threads;

    /**
     * @var PostRepository
     */
    private $posts;

    /**
     * @var UserRepository $users
     * @var ThreadRepository $threads
     * @var PostRepository $posts
     * @return void
     */
    public function __construct(UserRepository $users, ThreadRepository $threads, PostRepository $posts)
    {
        $this->users   = $users;
        $this->threads = $threads;
        $this->posts   = $posts;
    }

    /**
     * Create a new Post
     *
     * @param string $user_id
     * @param string $thread_id
     * @param string $body
     * @return Post
     */
    public function create($user_id, $thread_id, $body)
    {
        $user   = $this->findUserById($user_id);
        $thread = $this->findThreadById($thread_id);

        $post = $thread->createNewPost($user, $body);

        $this->posts->add($post);

        /* Dispatch Domain Events */

        return $post;
    }   

    /**
     * Find a User by their id
     *
     * @param string $id
     * @return User
     */
    private function findUserById($id)
    {
        $user = $this->users->userById(UserId::fromString($id));

        if ($user) return $user;

        throw new ValueNotFoundException("$id is not a valid user id");
    }

    /**
     * Find a Thread by its id
     *
     * @param string $id
     * @return Thread
     */
    private function findThreadById($id)
    {
        $thread = $this->threads->threadById(ThreadId::fromString($id));

        if ($thread) return $thread;

        throw new ValueNotFoundException("$id is not a valid thread id");
    }
}