<?php namespace Cribbb\Tests\Domain\Services\Groups;

use Cribbb\Domain\Model\Identity\User;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Identity\Username;
use Cribbb\Domain\Model\Identity\HashedPassword;
use Cribbb\Domain\Services\Groups\UserInGroupTranslator;

class UserInGroupTranslatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var User */
    private $user;

    /** @var UserInGroupTranslator */
    private $translator;

    public function setUp()
    {
        $this->user = User::register(
            UserId::generate(),
            new Email('name@domain.com'),
            new Username('username'),
            new HashedPassword('password')
        );

        $this->translator = new UserInGroupTranslator;
    }

    /** @test */
    public function should_create_member_from_user()
    {
        $member = $this->translator->memberFrom($this->user);

        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\Member', $member);
    }

    /** @test */
    public function should_create_admin_from_user()
    {
        $admin = $this->translator->adminFrom($this->user);

        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\Admin', $admin);
    }
}
