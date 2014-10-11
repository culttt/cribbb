<?php namespace Cribbb\Infrastructure\Repositories;

use Carbon\Carbon;
use Doctrine\ORM\EntityManager;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\Reminder;
use Cribbb\Domain\Model\Identity\ReminderId;
use Cribbb\Domain\Model\Identity\ReminderCode;
use Cribbb\Domain\Model\Identity\ReminderRepository;

class ReminderDoctrineORMRepository implements ReminderRepository
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * Create a new ReminderDoctrineORMRepository
     *
     * @param EntityManager $em
     * @return void
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Return the next identity
     *
     * @return ReminderId
     */
    public function nextIdentity()
    {
        return ReminderId::generate();
    }

    /**
     * Find a Reminder by Email and ReminderCode
     *
     * @param Email $email
     * @param ReminderCode $code
     * @return Reminder
     */
    public function findReminderByEmailAndCode(Email $email, ReminderCode $code)
    {
        $query = $this->em->createQuery('
            SELECT r FROM Cribbb\Domain\Model\Identity\Reminder r
            WHERE r.code = :code
            AND r.email = :email
            AND r.created_at < :timestamp
        ');

        $query->setParameters([
            'code'      => $code->toString(),
            'email'     => $email->toString(),
            'timestamp' => Carbon::now()->addHour()
        ]);

        return $query->getOneOrNullResult();
    }

    /**
     * Add a new Reminder
     *
     * @param Reminder $reminder
     * @return void
     */
    public function add(Reminder $reminder)
    {
        $this->em->persist($reminder);
        $this->em->flush();
    }

    /**
     * Delete a Reminder by it's ReminderCode
     *
     * @param RemindeCode $code
     * @return void
     */
    public function deleteReminderByCode(ReminderCode $code)
    {
        $query = $this->em->createQuery(
            'DELETE Cribbb\Domain\Model\Identity\Reminder r WHERE r.code = :code');

        $query->setParameters(['code' => $code->toString()]);

        $query->execute();
    }

    /**
     * Delete existing Reminders for Email
     *
     * @param Email $email
     * @return void
     */
    public function deleteExistingRemindersForEmail(Email $email)
    {
        $query = $this->em->createQuery(
            'DELETE Cribbb\Domain\Model\Identity\Reminder r WHERE r.email = :email');

        $query->setParameters(['email' => $email->toString()]);

        $query->execute();
    }

    /**
     * Delete all expired Reminders
     *
     * @return void
     */
    public function deleteExpiredReminders()
    {
        $query = $this->em->createQuery(
            'DELETE Cribbb\Domain\Model\Identity\Reminder r WHERE r.created_at < :timestamp');

        $query->setParameters(['timestamp' => Carbon::now()]);

        $query->execute();
    }
}
