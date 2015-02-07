<?php namespace Cribbb\Application\Groups;

use Cribbb\Domain\Model\Groups\GroupId;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Groups\GroupRepository;
use Cribbb\Domain\Model\ValueNotFoundException;
use Cribbb\Domain\Model\Identity\UserRepository;

class JoinGroup
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var GroupRepository
     */
    private $groups;

    /**
     * @var UserRepository $users
     * @var GroupRepository $groups
     * @return void
     */
    public function __construct(UserRepository $users, GroupRepository $groups)
    {
        $this->users  = $users;
        $this->groups = $groups;
    }

    /**
     * Allow a User to Join a Group
     *
     * @param string $user_id
     * @param string $group_id
     * @return Group
     */
    public function join($user_id, $group_id)
    {
        $user  = $this->findUserById($user_id);
        $group = $this->findGroupById($group_id);

        $group->addMember($user);

        /** Dispatch Domain Events */

        return $group;
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
     * Find a Group by its id
     *
     * @param string $id
     * @return Group
     */
    private function findGroupById($id)
    {
        $group = $this->groups->groupById(GroupId::fromString($id));

        if ($group) return $group;

        throw new ValueNotFoundException("$id is not a valid group id");
    }
}