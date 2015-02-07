<?php namespace Cribbb\Tests\Infrastructure\Repositories\Fixtures;

use Cribbb\Domain\Model\Groups\Name;
use Cribbb\Domain\Model\Groups\Slug;
use Cribbb\Domain\Model\Groups\Group;
use Cribbb\Domain\Model\Groups\GroupId;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

class GroupFixtures implements FixtureInterface
{
    /**
     * Load the Group fixtures
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $group = new Group(GroupId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc'), 'Cribbb');

        $manager->persist($group);
        $manager->flush();
    }
}
