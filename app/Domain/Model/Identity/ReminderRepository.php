<?php namespace Cribbb\Domain\Model\Identity;

interface ReminderRepository
{
    /**
     * Return the next identity
     *
     * @return ReminderId
     */
    public function nextIdentity();

    /**
     * Find a Reminder by Email and ReminderCode
     *
     * @param Email $email
     * @param ReminderCode $code
     * @return Reminder
     */
    public function findReminderByEmailAndCode(Email $email, ReminderCode $code);

    /**
     * Add a new Reminder
     *
     * @param Reminder $reminder
     * @return void
     */
    public function add(Reminder $reminder);

    /**
     * Delete a Reminder by it's ReminderCode
     *
     * @param RemindeCode $code
     * @return void
     */
    public function deleteReminderByCode(ReminderCode $code);

    /**
     * Delete existing Reminders for Email
     *
     * @param Email $email
     * @return void
     */
    public function deleteExistingRemindersForEmail(Email $email);

    /**
     * Delete all expired Reminders
     *
     * @return void
     */
    public function deleteExpiredReminders();
}
