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
        $id    = GroupId::generate();
        $name  = new Name('Cribbb');
        $group = new Group($id, $name, $name->toSlug());

        $manager->persist($group);
        $manager->flush();
    }
}
