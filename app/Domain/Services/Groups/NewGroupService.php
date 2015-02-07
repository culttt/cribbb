<?php namespace Cribbb\Domain\Services\Groups;

use Cribbb\Domain\Model\Groups\Group;
use Cribbb\Domain\Model\Identity\User;
use Cribbb\Domain\Model\Groups\GroupId;
use Cribbb\Domain\Model\Groups\NameIsUnique;
use Cribbb\Domain\Model\Groups\GroupRepository;
use Cribbb\Domain\Model\ValueIsNotUniqueException;

class NewGroupService
{
    /**
     * @var GroupRepository
     */
    private $groups;

    /**
     * @var GroupRepository $groups
     * @return void
     */
    public function __construct(GroupRepository $groups)
    {
        $this->groups = $groups;
    }

    /**
     * Create a new Group
     *
     * @param User $user
     * @param string $name
     * @return Group
     */
    public function create(User $user, $name)
    {
        $this->checkNameIsUnique($name);

        $group = new Group(GroupId::generate(), $name);
        $group->addAdmin($user);

        $this->groups->add($group);

        return $group;
    }

    /**
     * Check that a Group name is unique
     *
     * @param string $name
     * @throws ValueIsNotUniqueException
     * @return void
     */
    private function checkNameIsUnique($name)
    {
        $specification = new NameIsUnique($this->groups);

        if(! $specification->isSatisfiedBy($name)) {
            throw new ValueIsNotUniqueException("There is already a group called $name");
        }
    }
}