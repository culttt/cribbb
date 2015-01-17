<?php namespace Cribbb\Tests\Domain\Model\Identity;

use Cribbb\Domain\Model\Identity\User;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Identity\Setting;
use Cribbb\Domain\Model\Identity\Username;
use Cribbb\Domain\Model\Identity\SettingId;
use Cribbb\Domain\Model\Identity\HashedPassword;

class SettingTest extends \PHPUnit_Framework_TestCase
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

        $setting = new Setting(null, $this->user, 'new_follower');
    }

    /** @test */
    public function should_require_user()
    {
        $this->setExpectedException('Exception');

        $setting = new Setting(SettingId::generate(), null, 'new_follower');
    }

    /** @test */
    public function should_require_setting_key()
    {
        $this->setExpectedException('Exception');

        $setting = new Setting(SettingId::generate(), $this->user, null);
    }

    /** @test */
    public function should_create_setting()
    {
        $setting = new Setting(SettingId::generate(), $this->user, 'new_follower');

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\Setting', $setting);
        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\SettingId', $setting->id());
        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\User', $setting->user());
        $this->assertEquals('new_follower', $setting->key());
    }
}
