<?php namespace Cribbb\Domain\Model\Discussion;

use Carbon\Carbon;
use Assert\Assertion;
use Cribbb\Domain\RecordsEvents;
use Doctrine\ORM\Mapping as ORM;
use Cribbb\Domain\AggregateRoot;
use Cribbb\Domain\Model\Identity\User;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="posts")
 */
class Post implements AggregateRoot
{
    use RecordsEvents;

    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @ORM\ManyToOne(targetEntity="Cribbb\Domain\Model\Identity\User", inversedBy="posts")
     **/
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Cribbb\Domain\Model\Discussion\Thread", inversedBy="posts")
     **/
    private $thread;

    /**
     * @ORM\Column(type="date")
     */
    private $created_at;

    /**
     * Create a new Post
     *
     * @param PostId $PostId
     * @param User $user
     * @param Thread $thread
     * @param string $body
     * @return void
     */
    public function __construct(PostId $postId, User $user, Thread $thread, $body)
    {
        Assertion::string($body);

        $this->setId($postId);
        $this->setUser($user);
        $this->setThread($thread);
        $this->setBody($body);
        $this->setCreatedAt(new Carbon);
    }

    /**
     * Get the id
     *
     * @return PostId
     */
    public function id()
    {
        return PostId::fromString($this->id);
    }

    /**
     * Set the id
     *
     * @param PostId $id
     * @return void
     */
    private function setId(PostId $id)
    {
        $this->id = $id->toString();
    }

    /**
     * Set the User
     *
     * @return void
     */
    private function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the User
     *
     * @return User
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * Set the Thread
     *
     * @param Thread $thread
     * @return void
     */
    private function setThread(Thread $thread)
    {
        $this->thread = $thread;
    }

    /**
     * Get the Thread
     *
     * @return Thread
     */
    public function thread()
    {
        return $this->thread;
    }

    /**
     * Get the body
     *
     * @return string
     */
    public function body()
    {
        return $this->body;
    }

    /**
     * Set the body
     *
     * @param string $body
     * @return void
     */
    private function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get the created at timestamp
     *
     * @return Carbon
     */
    public function createdAt()
    {
        return Carbon::instance($this->created_at);
    }

    /**
     * Set the created at timestamp
     *
     * @param Carbon $created_at
     * @return void
     */
    private function setCreatedAt(Carbon $created_at)
    {
        $this->created_at = $created_at;
    }
}
