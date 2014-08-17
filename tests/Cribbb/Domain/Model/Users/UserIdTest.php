<?php namespace Cribbb\Domain\Model\Users;

use Rhumsaa\Uuid\Uuid;

class UserIdTest extends \PHPUnit_Framework_TestCase {

  /** @test */
  public function should_require_instance_of_uuid()
  {
    $this->setExpectedException('Exception');

    $id = new UserId;
  }

  /** @test */
  public function should_create_new_user_id()
  {
    $id = new UserId(Uuid::uuid4());

    $this->assertInstanceOf('Cribbb\Domain\Model\Users\UserId', $id);
  }

  /** @test */
  public function should_create_user_id_from_string()
  {
    $id = UserId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');

    $this->assertInstanceOf('Cribbb\Domain\Model\Users\UserId', $id);
  }

}



