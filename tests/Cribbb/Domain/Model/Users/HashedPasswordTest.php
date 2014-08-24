<?php namespace Cribbb\Domain\Model\Users;

class HashedPasswordTest extends \PHPUnit_Framework_TestCase {

  /** @test */
  public function should_require_password()
  {
    $this->setExpectedException('Exception');
    $password = new HashedPassword;
  }

  /** @test */
  public function should_require_valid_password()
  {
    $this->setExpectedException('Assert\AssertionFailedException');
    $password = new HashedPassword([]);
  }

  /** @test */
  public function should_accept_valid_password()
  {
    $password = new HashedPassword('ffsfewefhwuehfuiwhfiuwiufgiuwgewiugwefiuwbw');
    $this->assertInstanceOf('Cribbb\Domain\Model\Users\HashedPassword', $password);
  }

}
