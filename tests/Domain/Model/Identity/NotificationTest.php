<?php namespace Cribbb\Tests\Domain\Model\Identity;

use Cribbb\Domain\Model\Identity\User;
use Cribbb\Domain\Model\Identity\Notification;
use Cribbb\Domain\Model\Identity\NotificationId;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Identity\Username;
use Cribbb\Domain\Model\Identity\HashedPassword;

class NotificationTest extends \PHPUnit_Framework_TestCase
{
    /** @var User */
    private $user;

    public function setUp()
    {
        $this->user = User::register(
            UserId::generate(),
            new Email('name@domain.com'),
            new Username('username'),
            new HashedPassword('password')
        );
    }

    /** @test */
    public function should_require_id()
    {
        $this->setExpectedException('Exception');

        $notification = new Notification(null, $this->user, 'hello world');
    }

    /** @test */
    public function should_require_user()
    {
        $this->setExpectedException('Exception');

        $notification = new Notification(NotificationId::generate(), null, 'hello world');
    }

    /** @test */
    public function should_require_body()
    {
        $this->setExpectedException('Exception');

        $notification = new Notification(NotificationId::generate(), $this->user);
    }

    /** @test */
    public function should_create_notification()
    {
        $notification = new Notification(NotificationId::generate(), $this->user, 'hello world');

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\Notification', $notification);
        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\NotificationId', $notification->id());
        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\User', $notification->user());
        $this->assertEquals('hello world', $notification->body());
    }
}
