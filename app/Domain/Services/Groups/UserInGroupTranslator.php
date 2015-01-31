<?php namespace Cribbb\Domain\Services\Groups;

use Cribbb\Domain\Model\Groups\Admin;
use Cribbb\Domain\Model\Groups\Member;
use Cribbb\Domain\Model\Identity\User;

class UserInGroupTranslator
{
    /**
     * Translate a User to a Member
     *
     * @param User $user
     * @return Member
     */
    public function memberFrom(User $user)
    {
        return new Member($user->id(), $user->email(), $user->username());
    }

    /**
     * Translate a User to an Admin
     *
     * @param User $user
     * @return Admin
     */
    public function adminFrom(User $user)
    {
        return new Admin($user->id(), $user->email(), $user->username());
    }
}
