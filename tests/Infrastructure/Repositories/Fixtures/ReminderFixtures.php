<?php namespace Cribbb\Tests\Infrastructure\Repositories\Fixtures;

use Carbon\Carbon;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\Reminder;
use Cribbb\Domain\Model\Identity\ReminderId;
use Cribbb\Domain\Model\Identity\ReminderCode;
use Doctrine\Common\Persistence\ObjectManager;
use Cribbb\Domain\Model\Identity\HashedPassword;
use Doctrine\Common\DataFixtures\FixtureInterface;

class ReminderFixtures implements FixtureInterface
{
    /**
     * Load the User fixtures
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        // Create valid Reminder
        $id       = ReminderId::generate();
        $email    = new Email('first@domain.com');
        $code     = ReminderCode::fromNative('code+99');
        $reminder = new Reminder($id, $email, $code);
        $manager->persist($reminder);

        // Create expired Reminder
        Carbon::setTestNow(Carbon::create(2014, 10, 11, 10, 23, 34));
        $id       = ReminderId::generate();
        $email    = new Email('first@domain.com');
        $code     = ReminderCode::fromNative('code+1');
        $reminder = new Reminder($id, $email, $code);
        Carbon::setTestNow();

        $manager->persist($reminder);
        $manager->flush();
    }
}
