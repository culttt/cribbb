<?php namespace Cribbb\Tests\Infrastructure\Repositories\Fixtures;

use Cribbb\Domain\Model\Groups\Group;
use Cribbb\Domain\Model\Groups\GroupId;
use Cribbb\Domain\Model\Discussion\Thread;
use Cribbb\Domain\Model\Discussion\ThreadId;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

class ThreadFixtures implements FixtureInterface
{
    /**
     * Load the fixtures
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $group  = new Group(GroupId::generate(), 'Cribbb');

        $id = ThreadId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');
        $thread = new Thread($id, $group, 'Hello World');

        $manager->persist($thread);
        $manager->flush();
    }
}
