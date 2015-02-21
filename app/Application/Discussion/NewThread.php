<?php namespace Cribbb\Application\Discussion;

use Cribbb\Domain\Model\Groups\GroupId;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Groups\GroupRepository;
use Cribbb\Domain\Model\ValueNotFoundException;
use Cribbb\Domain\Model\Identity\UserRepository;
use Cribbb\Domain\Model\Discussion\ThreadRepository;

class NewThread
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
     * @var ThreadRepository
     */
    private $threads;

    /**
     * @var UserRepository $users
     * @var GroupRepository $groups
     * @var ThreadRepository $threads
     * @return void
     */
    public function __construct(UserRepository $users, GroupRepository $groups, ThreadRepository $threads)
    {
        $this->users   = $users;
        $this->groups  = $groups;
        $this->threads = $threads;
    }

    /**
     * Create a new Thread
     *
     * @param string $user_id
     * @param string $group_id
     * @param string $subject
     * @return Thread
     */
    public function create($user_id, $group_id, $subject)
    {
        $user  = $this->findUserById($user_id);
        $group = $this->findGroupById($group_id);

        $thread = $group->startNewThread($user, $subject);

        $this->threads->add($thread);

        /* Dispatch Domain Events */

        return $thread;
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