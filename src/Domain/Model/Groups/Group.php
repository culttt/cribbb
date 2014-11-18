<?php namespace Cribbb\Domain\Model\Groups;

use Cribbb\Domain\RecordsEvents;
use Doctrine\ORM\Mapping as ORM;
use Cribbb\Domain\AggregateRoot;
use Cribbb\Domain\Model\Identity\User;
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
     * @var UserInGroupTranslator
     */
    private $userInGroupTranslator;

    /**
     * Create a new Group
     *
     * @param GroupId $groupId
     * @param Name $name
     * @param Slug $slug
     * @return void
     */
    public function __construct(GroupId $groupId, Name $name, Slug $slug)
    {
        $this->setId($groupId);
        $this->setName($name);
        $this->setSlug($slug);

        $this->admins  = new ArrayCollection;
        $this->members = new ArrayCollection;

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
        return Name::fromNative($this->name);
    }

    /**
     * Set the Group's name
     *
     * @param Name $name
     * @return void
     */
    private function setName(Name $name)
    {
        $this->name = $name->toString();
    }

    /**
     * Get the Group's slug
     *
     * @return string
     */
    public function slug()
    {
        return Slug::fromNative($this->slug);
    }

    /**
     * Set the Group's slug
     *
     * @param Slug $slug
     * @return void
     */
    private function setSlug(Slug $slug)
    {
        $this->slug = $slug->toString();
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
}
