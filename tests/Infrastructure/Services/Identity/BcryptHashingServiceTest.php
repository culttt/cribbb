<?php namespace Cribbb\Tests\Infrastructure\Services\Identity;

use Illuminate\Hashing\BcryptHasher;
use Cribbb\Domain\Model\Identity\Password;
use Cribbb\Infrastructure\Services\Identity\BcryptHashingService;

class BcryptHashingServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_make_new_hashed_password_instance()
    {
        $service = new BcryptHashingService(new BcryptHasher);

        $hashed = $service->hash(new Password('my_super_secret_password'));

        $this->assertInstanceof('Cribbb\Domain\Model\Identity\HashedPassword', $hashed);
    }
}
