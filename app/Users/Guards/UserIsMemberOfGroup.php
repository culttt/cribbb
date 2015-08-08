<?php namespace Cribbb\Users\Guards;

use Cribbb\Foundation\Guards\Guard;
use Cribbb\Users\Exceptions\UserDoesNotBelongToGroup;

class UserIsMemberOfGroup extends Guard
{
    /**
     * Handle the Guard
     *
     * @param array $args
     * @return bool
     */
    public function handle(array $args)
    {
        $user  = $this->get('user', $args);
        $group = $this->get('group', $args);

        if ($user->groups->contains($group)) return true;

        throw new UserDoesNotBelongToGroup(
            'user_does_not_belong_to_group', $user->uuid, $group->uuid);
    }
}
