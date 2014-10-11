<?php namespace Cribbb\Tests\Infrastructure\Repositories;

use Illuminate\Support\Facades\App;
use Cribbb\Domain\Model\Identity\User;
use Illuminate\Support\Facades\Artisan;
use Cribbb\Domain\Model\Identity\Email;
use Doctrine\Common\DataFixtures\Loader;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Identity\Username;
use Cribbb\Domain\Model\Identity\HashedPassword;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Cribbb\Infrastructure\Repositories\UserDoctrineORMRepository;
use Cribbb\Tests\Infrastructure\Repositories\Fixtures\UserFixtures;

class UserDoctrineORMRepositoryTest extends \TestCase
{
    /** @var UserDoctrineORMRepository */
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
        $this->repository = new UserDoctrineORMRepository($this->em);

        $this->executor = new ORMExecutor($this->em, new ORMPurger);
        $this->loader   = new Loader;
        $this->loader->addFixture(new UserFixtures);
    }

    /** @test */
    public function should_return_next_identity()
    {
        $this->assertInstanceOf(
            'Cribbb\Domain\Model\Identity\UserId', $this->repository->nextIdentity());
    }

    /** @test */
    public function should_find_user_by_username()
    {
        $this->executor->execute($this->loader->getFixtures());

        $username = new Username('username');
        $user = $this->repository->userOfUsername($username);

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\User', $user);
        $this->assertEquals($username, $user->username());
    }

    /** @test */
    public function should_find_user_by_email()
    {
        $this->executor->execute($this->loader->getFixtures());

        $email = new Email('name@domain.com');
        $user = $this->repository->userOfEmail($email);

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\User', $user);
        $this->assertEquals($email, $user->email());
    }

    /** @test */
    public function should_add_new_user()
    {
        $id       = UserId::generate();
        $email    = new Email('name@domain.com');
        $username = new Username('username');
        $password = new HashedPassword('qwerty');

        $this->repository->add(User::register($id, $email, $username, $password));

        $this->em->clear();

        $user = $this->repository->userOfUsername(new Username('username'));

        $this->assertEquals($id,       $user->id());
        $this->assertEquals($email,    $user->email());
        $this->assertEquals($username, $user->username());
    }

    /** @test */
    public function should_update_existing_user()
    {
        $this->executor->execute($this->loader->getFixtures());

        $user = $this->repository->userOfUsername(new Username('username'));

        $username = new Username('new_username');
        $user->updateUsername($username);

        $this->repository->update($user);

        $this->em->clear();

        $user = $this->repository->userOfUsername($username);

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\User', $user);
        $this->assertEquals($username, $user->username());
    }
}
