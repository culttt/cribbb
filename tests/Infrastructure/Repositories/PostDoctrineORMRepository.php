<?php namespace Cribbb\Tests\Infrastructure\Repositories;

use Illuminate\Support\Facades\App;
use Cribbb\Domain\Model\Groups\Group;
use Cribbb\Domain\Model\Identity\User;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Groups\GroupId;
use Illuminate\Support\Facades\Artisan;
use Cribbb\Domain\Model\Discussion\Post;
use Cribbb\Domain\Model\Identity\UserId;
use Doctrine\Common\DataFixtures\Loader;
use Cribbb\Domain\Model\Discussion\Thread;
use Cribbb\Domain\Model\Discussion\PostId;
use Cribbb\Domain\Model\Identity\Username;
use Cribbb\Domain\Model\Discussion\ThreadId;
use Cribbb\Domain\Model\Identity\HashedPassword;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Cribbb\Infrastructure\Repositories\PostDoctrineORMRepository;
use Cribbb\Tests\Infrastructure\Repositories\Fixtures\PostFixtures;

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
        $this->repository = new PostDoctrineORMRepository($this->em);

        $this->executor = new ORMExecutor($this->em, new ORMPurger);
        $this->loader   = new Loader;
        $this->loader->addFixture(new PostFixtures);
    }

    /** @test */
    public function should_find_post_by_id()
    {
        $this->executor->execute($this->loader->getFixtures());

        $post = $this->repository->threadOfId(PostId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc'));

        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\Post', $post);
        $this->assertEquals('d16f9fe7-e947-460e-99f6-2d64d65f46bc', $post->id());
    }

    /** @test */
    public function should_add_new_post()
    {
        $user = User::register(
            UserId::generate(),
            new Email('name@domain.com'),
            new Username('username'),
            new HashedPassword('qwerty')
        );
        $group  = new Group(GroupId::generate(), 'Cribbb');
        $thread = new Thread(ThreadId::generate(), $group, 'Hello World');
        $id = PostId::generate();
        $post   = new Post($id, $user, $thread, 'Hello world');

        $this->repository->add($post);

        $this->em->clear();

        $post = $this->repository->postOfId($id);

        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\PostId', $post->id());
        $this->assertEquals('hello-world', $post->slug());
    }
}
