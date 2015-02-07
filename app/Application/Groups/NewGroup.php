<?php namespace Cribbb\Application\Groups;

use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\ValueNotFoundException;
use Cribbb\Domain\Model\Identity\UserRepository;
use Cribbb\Domain\Services\Groups\NewGroupService;

class NewGroup
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var NewGroupService
     */
    private $service;

    /**
     * @var UserRepository $users
     * @var NewGroupService $service
     * @return void
     */
    public function __construct(UserRepository $users, NewGroupService $service)
    {
        $this->users   = $users;
        $this->service = $service;
    }

    /**
     * Create a new Group
     *
     * @param string $user_id
     * @param string $name
     * @return Group
     */
    public function create($user_id, $name)
    {
        $user = $this->findUserById($user_id);

        $group = $this->service->create($user, $name);

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
}