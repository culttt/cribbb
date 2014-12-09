<?php namespace Cribbb\Tests\Infrastructure\Repositories;

use Illuminate\Support\Facades\App;
use Cribbb\Domain\Model\Groups\Group;
use Cribbb\Domain\Model\Groups\GroupId;
use Illuminate\Support\Facades\Artisan;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Cribbb\Infrastructure\Repositories\GroupDoctrineORMRepository;
use Cribbb\Tests\Infrastructure\Repositories\Fixtures\GroupFixtures;

class GroupDoctrineORMRepositoryTest extends \TestCase
{
    /** @var GroupDoctrineORMRepository */
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
        $this->repository = new GroupDoctrineORMRepository($this->em);

        $this->executor = new ORMExecutor($this->em, new ORMPurger);
        $this->loader   = new Loader;
        $this->loader->addFixture(new GroupFixtures);
    }

    /** @test */
    public function should_return_next_identity()
    {
        $this->assertInstanceOf(
            'Cribbb\Domain\Model\Groups\GroupId', $this->repository->nextIdentity());
    }

    /** @test */
    public function should_find_name_by_name()
    {
        $this->executor->execute($this->loader->getFixtures());

        $group = $this->repository->groupOfName('Cribbb');

        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\Group', $group);
        $this->assertEquals('Cribbb', $group->name());
    }

    /** @test */
    public function should_find_group_by_slug()
    {
        $this->executor->execute($this->loader->getFixtures());

        $group = $this->repository->groupOfSlug('cribbb');

        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\Group', $group);
        $this->assertEquals('cribbb', $group->slug());
    }

    /** @test */
    public function should_add_new_group()
    {
        $this->repository->add(new Group(GroupId::generate(), 'Cribbb'));

        $this->em->clear();

        $group = $this->repository->groupOfName('Cribbb');

        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\GroupId', $group->id());
        $this->assertEquals('Cribbb', $group->name());
        $this->assertEquals('cribbb', $group->slug());
    }
}
