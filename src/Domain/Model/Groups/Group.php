<?php namespace Cribbb\Domain\Model\Groups;

use Cribbb\Domain\RecordsEvents;
use Doctrine\ORM\Mapping as ORM;
use Cribbb\Domain\AggregateRoot;

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
    }

    /**
     * Get the Group's id
     *
     * @return Group
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
}
