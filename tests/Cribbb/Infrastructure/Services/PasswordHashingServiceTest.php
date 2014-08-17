<?php namespace Cribbb\Infrastructure\Services;

use Illuminate\Hashing\BcryptHasher;
use Cribbb\Domain\Model\Users\Password;

class PasswordHashingServiceTest extends \PHPUnit_Framework_TestCase {

  /** @var PasswordHashingService */
  private $service;

  public function setUp()
  {
    $this->service = new PasswordHashingService(new BcryptHasher);
  }

  /** @test */
  public function should_make_new_hashed_password_instance()
  {
    $password = new Password('my_super_secret_password');
    $hashed = $this->service->make($password);

    $this->assertInstanceof('Cribbb\Domain\Model\Users\HashedPassword', $hashed);
    $this->assertTrue($this->service->check($password, $hashed));
  }

}
