<?php namespace Cribbb\Application;

use Mockery as m;
use Rhumsaa\Uuid\Uuid;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Identity\HashedPassword;
use Cribbb\Application\Commands\RegisterUserCommand;

class IdentityApplicationServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @var UserRepository */
    private $repository;

    /** @var HashingService */
    private $hashing;

    /** @var Dispatcher */
    private $dispatcher;

    /** @var IdentityApplicationService */
    private $service;

    /** @var UserId */
    private $uuid;

    /** @var HashedPassword */
    private $password;

    public function setUp()
    {
        $this->repository = m::mock('Cribbb\Domain\Model\Identity\UserRepository');
        $this->hashing = m::mock('Cribbb\Domain\Model\Identity\HashingService');
        $this->dispatcher = m::mock('BigName\EventDispatcher\Dispatcher');
        $this->service = new IdentityApplicationService($this->repository, $this->hashing, $this->dispatcher);
        $this->uuid = new UserId(Uuid::uuid4());
        $this->password = new HashedPassword('password');
    }

    /** @test */
    public function should_throw_exception_if_email_is_not_unique()
    {
        $this->setExpectedException('Cribbb\Domain\Model\Identity\ValueIsNotUniqueException');

        $this->repository->shouldReceive('userOfEmail')->andReturn(true);

        $user = $this->service->registerUser('name@domain.com', 'username', 'password');
    }

    /** @test */
    public function should_throw_exception_if_username_is_not_unique()
    {
        $this->setExpectedException('Cribbb\Domain\Model\Identity\ValueIsNotUniqueException');

        $this->repository->shouldReceive('userOfEmail')->andReturn(null);
        $this->repository->shouldReceive('userOfUsername')->andReturn(true);

        $user = $this->service->registerUser('name@domain.com', 'username', 'password');
    }

    /** @test */
    public function should_register_new_user()
    {
        $this->repository->shouldReceive('userOfEmail')->andReturn(null);
        $this->repository->shouldReceive('userOfUsername')->andReturn(null);
        $this->repository->shouldReceive('nextIdentity')->andReturn($this->uuid);
        $this->hashing->shouldReceive('hash')->andReturn($this->password);
        $this->repository->shouldReceive('add');
        $this->dispatcher->shouldReceive('dispatch');

        $user = $this->service->registerUser('name@domain.com', 'username', 'password');
        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\User', $user);
    }
}
