<?php namespace Cribbb\Tests\Infrastructure\Repositories\Fixtures;

use Cribbb\Domain\Model\Groups\Group;
use Cribbb\Domain\Model\Identity\User;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Groups\GroupId;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Discussion\Post;
use Cribbb\Domain\Model\Discussion\PostId;
use Cribbb\Domain\Model\Discussion\Thread;
use Cribbb\Domain\Model\Identity\Username;
use Cribbb\Domain\Model\Discussion\ThreadId;
use Doctrine\Common\Persistence\ObjectManager;
use Cribbb\Domain\Model\Identity\HashedPassword;
use Doctrine\Common\DataFixtures\FixtureInterface;

class PostFixtures implements FixtureInterface
{
    /**
     * Load the fixtures
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $user = User::register(
            UserId::generate(),
            new Email('name@domain.com'),
            new Username('username'),
            new HashedPassword('qwerty')
        );

        $group  = new Group(GroupId::generate(), 'Cribbb');
        $thread = new Thread(ThreadId::generate(), $group, 'Hello World');

        $post = new Post(
            PostId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc'),
            $user,
            $thread,
            'Hello world.'
        );

        $manager->persist($post);
        $manager->flush();
    }
}


