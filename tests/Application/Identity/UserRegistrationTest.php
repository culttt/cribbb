<?php namespace Cribbb\Tests\Application\Identity;

use Mockery as m;
use Illuminate\Support\Facades\App;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Artisan;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Application\Identity\UserRegistration;
use Cribbb\Domain\Services\Identity\RegisterUserService;
use Cribbb\Infrastructure\Services\Identity\BcryptHashingService;

class UserRegistrationTest extends \TestCase
{
    /** @var UserRegistration */
    private $service;

    /** @var UserRepository */
    private $repository;

    public function setUp()
    {
        parent::setUp();

        Artisan::call('doctrine:schema:create');

        $this->repository = m::mock('Cribbb\Domain\Model\Identity\UserRepository');

        $this->service = new UserRegistration(
            new RegisterUserService(
                $this->repository,
                new BcryptHashingService(new BcryptHasher)
            )
        );
    }

    /** @test */
    public function should_only_accept_valid_email_addresses()
    {
        $this->assertFalse($this->service->validate(['email' => '...']));

        $this->assertEquals(1, $this->service->errors()->count());
    }

    /** @test */
    public function should_only_accept_valid_usernames()
    {
        $this->assertFalse($this->service->validate(['username' => '$_$']));

        $this->assertEquals(1, $this->service->errors()->count());
    }

    /** @test */
    public function should_register_new_user()
    {
        $this->repository->shouldReceive('userOfEmail')->once()->andReturn(null);
        $this->repository->shouldReceive('userOfUsername')->once()->andReturn(null);
        $this->repository->shouldReceive('nextIdentity')->once()->andReturn(UserId::generate());
        $this->repository->shouldReceive('add')->once();

        $user = $this->service->register('name@domain.com', 'username', 'password');

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\User', $user);
    }
}