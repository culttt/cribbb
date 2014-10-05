<?php namespace Cribbb\Domain\Model\Identity;

interface PasswordReminderRepository
{
    /**
     * Find a reminder by Email and ReminderCode
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
     * Delete a reminder by it's ReminderCode
     *
     * @param RemindeCode $code
     * @return void
     */
    public function deleteReminderByCode(ReminderCode $code);

    /**
     * Delete existing reminders for email
     *
     * @param Email $email
     * @return void
     */
    public function deleteExistingRemindersForEmail(Email $email);

    /**
     * Delete all expired reminders
     *
     * @return void
     */
    public function deleteExpiredReminders();
}
