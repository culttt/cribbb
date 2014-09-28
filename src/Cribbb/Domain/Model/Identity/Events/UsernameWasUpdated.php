<?php namespace Cribbb\Domain\Model\Identity\Events;

use Cribbb\Gettable;
use BigName\EventDispatcher\Event;
use Cribbb\Domain\Model\Identity\User;

class UsernameWasUpdated implements Event
{
    use Gettable;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new PasswordWasReset event
     *
     * @param User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Return the name of the event
     *
     * @return string
     */
    public function getName()
    {
        return 'UsernameWasUpdated';
    }
}
