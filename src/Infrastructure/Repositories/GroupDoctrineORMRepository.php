<?php namespace Cribbb\Infrastructure\Repositories;

use Doctrine\ORM\EntityManager;
use Cribbb\Domain\Model\Groups\Name;
use Cribbb\Domain\Model\Groups\Slug;
use Cribbb\Domain\Model\Groups\Group;
use Cribbb\Domain\Model\Groups\GroupId;
use Cribbb\Domain\Model\Groups\GroupRepository;

class GroupDoctrineORMRepository implements GroupRepository
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var string
     */
    private $class;

    /**
     * Create a new GroupDoctrineORMRepository
     *
     * @param EntityManager $em
     * @return void
     */
    public function __construct(EntityManager $em)
    {
        $this->em    = $em;
        $this->class = 'Cribbb\Domain\Model\Groups\Group';
    }

    /**
     * Return the next identity
     *
     * @return GroupId
     */
    public function nextIdentity()
    {
        return GroupId::generate();
    }

    /**
     * Add a new Group
     *
     * @param Group $group
     * @return void
     */
    public function add(Group $group)
    {
        $this->em->persist($group);
        $this->em->flush();
    }

    /**
     * Find a Group by it's Name
     *
     * @param Name $name
     * @return Group
     */
    public function groupOfName(Name $name)
    {
        return $this->em->getRepository($this->class)->findOneBy([
            'name' => $name->toString()
        ]);
    }

    /**
     * Find a Group by it's Slug
     *
     * @param Slug $slug
     * @return Group
     */
    public function groupOfSlug(Slug $slug)
    {
        return $this->em->getRepository($this->class)->findOneBy([
            'slug' => $slug->toString()
        ]);
    }
}
