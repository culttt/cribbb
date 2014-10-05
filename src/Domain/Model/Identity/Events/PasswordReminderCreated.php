<?php namespace Cribbb\Domain\Model\Identity\Events;

use Cribbb\Gettable;
use BigName\EventDispatcher\Event;
use Cribbb\Domain\Model\Identity\Reminder;

class PasswordReminderCreated implements Event
{
    use Gettable;

    /**
     * @var Reminder
     */
    private $reminder;

    /**
     * Create a new PasswordReminderCreated event
     *
     * @param Reminder $reminder
     * @return void
     */
    public function __construct(Reminder $reminder)
    {
        $this->reminder = $reminder;
    }

    /**
     * Return the name of the event
     *
     * @return string
     */
    public function getName()
    {
        return 'PasswordReminderCreated';
    }
}
