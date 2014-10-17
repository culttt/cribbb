<?php namespace Cribbb\Tests\Infrastructure\Repositories;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Cribbb\Domain\Model\Identity\Email;
use Doctrine\Common\DataFixtures\Loader;
use Cribbb\Domain\Model\Identity\Reminder;
use Cribbb\Domain\Model\Identity\ReminderId;
use Cribbb\Domain\Model\Identity\ReminderCode;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Cribbb\Infrastructure\Repositories\ReminderDoctrineORMRepository;
use Cribbb\Tests\Infrastructure\Repositories\Fixtures\ReminderFixtures;

class ReminderDoctrineORMRepositoryTest extends \TestCase
{
    /** @var ReminderDoctrineORMRepository */
    private $repository;

    /** @var EntityManager */
    private $em;

    /** @var ORMExecutor */
    private $executor;

    /** @var Loader */
    private $loader;

    public function setUp()
    {
        parent::setUp();

        Artisan::call('doctrine:schema:create');

        $this->em         = App::make('Doctrine\ORM\EntityManagerInterface');
        $this->repository = new ReminderDoctrineORMRepository($this->em);

        $this->executor = new ORMExecutor($this->em, new ORMPurger);
        $this->loader   = new Loader;
        $this->loader->addFixture(new ReminderFixtures);
    }

    /** @test */
    public function should_return_next_identity()
    {
        $this->assertInstanceOf(
            'Cribbb\Domain\Model\Identity\ReminderId', $this->repository->nextIdentity());
    }

    /** @test */
    public function should_find_reminder_by_email_and_code()
    {
        $this->executor->execute($this->loader->getFixtures());

        $code     = ReminderCode::fromNative('code+99');
        $email    = new Email('first@domain.com');
        $reminder = $this->repository->findReminderByEmailAndCode($email, $code);

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\Reminder', $reminder);
        $this->assertEquals($code,  $reminder->code());
        $this->assertEquals($email, $reminder->email());
    }

    /** @test */
    public function should_add_new_reminder()
    {
        $id       = ReminderId::generate();
        $code     = ReminderCode::fromNative('new');
        $email    = new Email('new@domain.com');
        $reminder = new Reminder($id, $email, $code);

        $this->repository->add($reminder);

        $this->em->clear();

        $reminder = $this->repository->findReminderByEmailAndCode($email, $code);

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\Reminder', $reminder);
        $this->assertEquals($code,  $reminder->code());
        $this->assertEquals($email, $reminder->email());
    }

    /** @test */
    public function should_delete_reminder_by_code()
    {
        $this->executor->execute($this->loader->getFixtures());

        $code  = ReminderCode::fromNative('code+99');
        $email = new Email('new@domain.com');

        $this->repository->deleteReminderByCode($code);

        $reminder = $this->repository->findReminderByEmailAndCode($email, $code);

        $this->assertEquals(null, $reminder);
    }

    /** @test */
    public function should_delete_existing_reminders_by_email()
    {
        $this->executor->execute($this->loader->getFixtures());

        $code  = ReminderCode::fromNative('code+99');
        $email = new Email('new@domain.com');

        $this->repository->deleteExistingRemindersForEmail($email);

        $reminder = $this->repository->findReminderByEmailAndCode($email, $code);

        $this->assertEquals(null, $reminder);
    }

    /** @test */
    public function should_delete_expired_reminders()
    {
        $this->executor->execute($this->loader->getFixtures());

        $code  = ReminderCode::fromNative('code+1');
        $email = new Email('new@domain.com');

        $this->repository->deleteExpiredReminders();

        $reminder = $this->repository->findReminderByEmailAndCode($email, $code);

        $this->assertEquals(null, $reminder);
    }
}
