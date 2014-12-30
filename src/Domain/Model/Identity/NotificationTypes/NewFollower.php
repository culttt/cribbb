<?php namespace Cribbb\Domain\Model\Identity\NotificationTypes;

use Cribbb\Domain\Model\Identity\NotificationType;

class NewFollower implements NotificationType
{
    /**
     * Return the Notification Type tag
     *
     * @return string
     */
    public function tag()
    {
        return 'new_follower';
    }
}
