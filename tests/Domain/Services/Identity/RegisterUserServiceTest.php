<?php namespace Cribbb\Tests\Domain\Services\Identity;

use Mockery as m;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Identity\HashedPassword;
use Cribbb\Domain\Services\Identity\RegisterUserService;

class RegisterUserServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @var UserRepository */
    private $repository;

    /** @var HashingService */
    private $hashing;

    /** @var RegisterUserService */
    private $service;

    public function setUp()
    {
        $this->repository = m::mock('Cribbb\Domain\Model\Identity\UserRepository');
        $this->hashing    = m::mock('Cribbb\Domain\Services\Identity\HashingService');

        $this->service = new RegisterUserService($this->repository, $this->hashing);
    }

    /** @test */
    public function should_throw_exception_if_email_is_not_unique()
    {
        $this->setExpectedException('Cribbb\Domain\Model\ValueIsNotUniqueException');

        $this->repository->shouldReceive('userOfEmail')->andReturn(true);

        $user = $this->service->register('name@domain.com', 'username', 'password');
    }

    /** @test */
    public function should_throw_exception_if_username_is_not_unique()
    {
        $this->setExpectedException('Cribbb\Domain\Model\ValueIsNotUniqueException');

        $this->repository->shouldReceive('userOfEmail')->andReturn(null);
        $this->repository->shouldReceive('userOfUsername')->andReturn(true);

        $user = $this->service->register('name@domain.com', 'username', 'password');
    }

    /** @test */
    public function should_register_new_user()
    {
        $this->repository->shouldReceive('userOfEmail')->andReturn(null);
        $this->repository->shouldReceive('userOfUsername')->andReturn(null);
        $this->repository->shouldReceive('nextIdentity')->andReturn(UserId::generate());
        $this->hashing->shouldReceive('hash')->andReturn(new HashedPassword('password'));
        $this->repository->shouldReceive('add');

        $user = $this->service->register('name@domain.com', 'username', 'password');
        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\User', $user);
    }
}
