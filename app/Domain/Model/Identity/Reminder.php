<?php namespace Cribbb\Domain\Model\Identity;

use Carbon\Carbon;
use Cribbb\Domain\RecordsEvents;
use Doctrine\ORM\Mapping as ORM;
use Cribbb\Domain\AggregateRoot;
use Cribbb\Domain\Model\Identity\Events\ReminderWasCreated;

/**
 * @ORM\Entity
 * @ORM\Table(name="reminders")
 */
class Reminder implements AggregateRoot
{
    use RecordsEvents;

    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $code;

    /**
     * @ORM\Column(type="string")
     */
    private $created_at;

    /**
     * Create a new Reminder
     *
     * @param ReminderId $reminderId
     * @param Email $email
     * @param ReminderCode $code
     * @return void
     */
    public function __construct(ReminderId $reminderId, Email $email, ReminderCode $code)
    {
        $this->setId($reminderId);
        $this->setEmail($email);
        $this->setCode($code);
        $this->setCreatedAt(Carbon::now());

        $this->record(new ReminderWasCreated);
    }

    /**
     * Get the Reminder id
     *
     * @return ReminderId
     */
    public function id()
    {
        return ReminderId::fromString($this->id);
    }

    /**
     * Set the Reminder id
     *
     * @param ReminderId $id
     * @return void
     */
    private function setId(ReminderId $id)
    {
        $this->id = $id->toString();
    }

    /**
     * Get the Reminder email
     *
     * @return string
     */
    public function email()
    {
        return Email::fromNative($this->email);
    }

    /**
     * Set the Reminder email
     *
     * @param Email $email
     * @return void
     */
    private function setEmail(Email $email)
    {
        $this->email = $email->toString();
    }

    /**
     * Get the Reminder code
     *
     * @return string
     */
    public function code()
    {
        return ReminderCode::fromNative($this->code);
    }

    /**
     * Set the Reminder Code
     *
     * @param ReminderCode $code
     * @return void
     */
    private function setCode(ReminderCode $code)
    {
        $this->code = $code->toString();
    }

    /**
     * Get the Created At timestamp
     *
     * @return string
     */
    public function createdAt()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at);
    }

    /**
     * Set the Created At timestamp
     *
     * @param Carbon $timestamp
     * @return void
     */
    private function setCreatedAt(Carbon $timestamp)
    {
        $this->created_at = $timestamp->toDateTimeString();
    }

    /**
     * Check to see if the Reminder is valid
     *
     * @return bool
     */
    public function isValid()
    {
        return $this->createdAt()->addHour()->isFuture();
    }
}
