<?php namespace Cribbb\Domain\Model\Groups;

use Exception;
use Assert\Assertion;
use Illuminate\Support\Str;
use Cribbb\Domain\RecordsEvents;
use Doctrine\ORM\Mapping as ORM;
use Cribbb\Domain\AggregateRoot;
use Cribbb\Domain\Model\Identity\User;
use Cribbb\Domain\Model\Discussion\Thread;
use Cribbb\Domain\Model\Discussion\ThreadId;
use Doctrine\Common\Collections\ArrayCollection;
use Cribbb\Domain\Services\Groups\UserInGroupTranslator;

/**
 * @ORM\Entity
 * @ORM\Table(name="groups")
 */
class Group implements AggregateRoot
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
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="Cribbb\Domain\Model\Identity\User", mappedBy="adminOf")
     **/
    private $admins;

    /**
     * @ORM\ManyToMany(targetEntity="Cribbb\Domain\Model\Identity\User", mappedBy="memberOf")
     **/
    private $members;

    /**
     * @ORM\OneToMany(targetEntity="Cribbb\Domain\Model\Discussion\Thread", mappedBy="group")
     **/
    private $threads;

    /**
     * @var UserInGroupTranslator
     */
    private $userInGroupTranslator;

    /**
     * Create a new Group
     *
     * @param GroupId $groupId
     * @param string $name
     * @return void
     */
    public function __construct(GroupId $groupId, $name)
    {
        Assertion::string($name);

        $this->setId($groupId);
        $this->setName($name);
        $this->setSlug(Str::slug($name));

        $this->admins  = new ArrayCollection;
        $this->members = new ArrayCollection;
        $this->threads = new ArrayCollection;

        $this->userInGroupTranslator = new UserInGroupTranslator;
    }

    /**
     * Get the Group's id
     *
     * @return GroupId
     */
    public function id()
    {
        return GroupId::fromString($this->id);
    }

    /**
     * Set the Group's id
     *
     * @param GroupId $id
     * @return void
     */
    private function setId(GroupId $id)
    {
        $this->id = $id->toString();
    }

    /**
     * Get the Group's name
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Set the Group's name
     *
     * @param string $name
     * @return void
     */
    private function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the Group's slug
     *
     * @return string
     */
    public function slug()
    {
        return $this->slug;
    }

    /**
     * Set the Group's slug
     *
     * @param $slug
     * @return void
     */
    private function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Add a User to the Group as a Member
     *
     * @param User $user
     * @return void
     */
    public function addMember(User $user)
    {
        $this->members[] = $user;
    }

    /**
     * Return the Members of the Group
     *
     * @return ArrayCollection
     */
    public function members()
    {
        return $this->members->map(function ($user) {
            return $this->userInGroupTranslator->memberFrom($user);
        });
    }

    /**
     * Add an User to the Group as an Admin
     *
     * @param User $user
     * @return void
     */
    public function addAdmin(User $user)
    {
        $this->admins[] = $user;
    }

    /**
     * Return the Admins of the Group
     *
     * @return ArrayCollection
     */
    public function admins()
    {
        return $this->admins->map(function ($user) {
            return $this->userInGroupTranslator->adminFrom($user);
        });
    }

    /**
     * Start a new Thread
     *
     * @param User $user
     * @param string $subject
     * @return Thread
     */
    public function startNewThread(User $user, $subject)
    {
        if ($this->members->contains($user)) {
            $thread = new Thread(ThreadId::generate(), $subject, $this);

            $this->addThread($thread);

            return $thread;
        }

        throw new Exception('This user is not a member of the Group!');
    }

    /**
     * Add a new Thread
     *
     * @param Thread $thread
     * @return void
     */
    private function addThread(Thread $thread)
    {
        $this->threads[] = $thread;
    }

    /**
     * Return the Threads Collection
     *
     * @return ArrayCollection
     */
    public function threads()
    {
        return $this->threads;
    }
}
