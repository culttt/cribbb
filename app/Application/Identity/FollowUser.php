<?php namespace Cribbb\Application\Identity;

use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\ValueNotFoundException;
use Cribbb\Domain\Model\Identity\UserRepository;

class FollowUser
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var UserRepository $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Follow another User
     *
     * @param string $current_user_id
     * @param string $user_to_follow_id
     * @return User
     */
    public function follow($current_user_id, $user_to_follow_id)
    {
        $user   = $this->findUserById($current_user_id);
        $friend = $this->findUserById($user_to_follow_id);

        $user->follow($friend);

        /** Dispatch Domain Events */

        return $user;
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