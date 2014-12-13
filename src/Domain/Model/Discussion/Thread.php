<?php namespace Cribbb\Domain\Model\Discussion;

use Exception;
use Assert\Assertion;
use Illuminate\Support\Str;
use Cribbb\Domain\RecordsEvents;
use Doctrine\ORM\Mapping as ORM;
use Cribbb\Domain\AggregateRoot;
use Cribbb\Domain\Model\Groups\Group;
use Doctrine\Common\Collections\ArrayCollection;

use Cribbb\Domain\Model\Identity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="threads")
 */
class Thread implements AggregateRoot
{
    use RecordsEvents;

    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $subject;

    /**
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="Cribbb\Domain\Model\Groups\Group", inversedBy="threads")
     **/
    private $group;

    /**
     * @ORM\OneToMany(targetEntity="Cribbb\Domain\Model\Discussion\Post", mappedBy="thread")
     **/
    private $posts;

    /**
     * Create a new Thread
     *
     * @param ThreadId $threadId
     * @param Group $group
     * @param string $subject
     * @return void
     */
    public function __construct(ThreadId $threadId, Group $group, $subject)
    {
        Assertion::string($subject);

        $this->setId($threadId);
        $this->setGroup($group);
        $this->setSubject($subject);
        $this->setSlug(Str::slug($subject));

        $this->posts = new ArrayCollection;
    }

    /**
     * Get the id
     *
     * @return ThreadId
     */
    public function id()
    {
        return ThreadId::fromString($this->id);
    }

    /**
     * Set the id
     *
     * @param GroupId $id
     * @return void
     */
    private function setId(ThreadId $id)
    {
        $this->id = $id->toString();
    }

    /**
     * Get the subject
     *
     * @return string
     */
    public function subject()
    {
        return $this->subject;
    }

    /**
     * Set the subject
     *
     * @param string $subject
     * @return void
     */
    private function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * Get the slug
     *
     * @return string
     */
    public function slug()
    {
        return $this->slug;
    }

    /**
     * Set the slug
     *
     * @param string $slug
     * @return void
     */
    private function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Set the Group
     *
     * @return void
     */
    private function setGroup(Group $group)
    {
        $this->group = $group;
    }

    /**
     * Get the Group
     *
     * @return Group
     */
    public function group()
    {
        return $this->group;
    }

    /**
     * Create new Post
     *
     * @param User $user
     * @param string $body
     * @return Post
     */
    public function createNewPost(User $user, $body)
    {
        if ($this->group->isMember($user)) {
            $post = new Post(PostId::generate(), $user, $this, $body);

            $this->addPost($post);

            return $post;
        }

        throw new Exception('This user is not a member of the Group!');
    }

    /**
     * Add a new Post
     *
     * @param Post $post
     * @return void
     */
    private function addPost(Post $post)
    {
        $this->posts[] = $post;
    }

    /**
     * Get all the Posts
     *
     * @return ArrayCollection
     */
    public function posts()
    {
        return $this->posts;
    }
}
