<?php namespace Cribbb\Tests\Infrastructure\Repositories\Fixtures;

use Cribbb\Domain\Model\Identity\User;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Identity\Username;
use Doctrine\Common\Persistence\ObjectManager;
use Cribbb\Domain\Model\Identity\HashedPassword;
use Doctrine\Common\DataFixtures\FixtureInterface;

class UserFixtures implements FixtureInterface
{
    /**
     * Load the User fixtures
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $id       = UserId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');
        $email    = new Email('name@domain.com');
        $username = new Username('username');
        $password = new HashedPassword('qwerty');

        $user = User::register($id, $email, $username, $password);

        $manager->persist($user);
        $manager->flush();
    }
}
