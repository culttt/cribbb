<?php namespace Cribbb\Domain\Model\Identity;

interface NotificationType
{
    /**
     * Return the Notification Type tag
     *
     * @return string
     */
    public function tag();
}
