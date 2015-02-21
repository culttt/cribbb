<?php namespace Cribbb\Tests\Infrastructure\Repositories;

use Illuminate\Support\Facades\App;
use Cribbb\Domain\Model\Groups\Group;
use Cribbb\Domain\Model\Groups\GroupId;
use Illuminate\Support\Facades\Artisan;
use Doctrine\Common\DataFixtures\Loader;
use Cribbb\Domain\Model\Discussion\Thread;
use Cribbb\Domain\Model\Discussion\ThreadId;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Cribbb\Infrastructure\Repositories\ThreadDoctrineORMRepository;
use Cribbb\Tests\Infrastructure\Repositories\Fixtures\ThreadFixtures;

class ThreadDoctrineORMRepositoryTest extends \TestCase
{
    /** @var ThreadDoctrineORMRepository */
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
        $this->repository = new ThreadDoctrineORMRepository($this->em);

        $this->executor = new ORMExecutor($this->em, new ORMPurger);
        $this->loader   = new Loader;
        $this->loader->addFixture(new ThreadFixtures);
    }

    /** @test */
    public function should_find_thread_by_id()
    {
        $this->executor->execute($this->loader->getFixtures());

        $thread = $this->repository->threadOfId(ThreadId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc'));

        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\Thread', $thread);
        $this->assertEquals('d16f9fe7-e947-460e-99f6-2d64d65f46bc', $thread->id());
    }

    /** @test */
    public function should_add_new_group()
    {
        $group = new Group(GroupId::generate(), 'Cribbb');
        $id = ThreadId::generate();
        $thread = new Thread($id, $group, 'Hello World');

        $this->repository->add($thread);

        $this->em->clear();

        $group = $this->repository->threadOfId($id);

        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\ThreadId', $group->id());
        $this->assertEquals('hello-world', $group->slug());
    }
}
