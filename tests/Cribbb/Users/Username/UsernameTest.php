<?php namespace Cribbb\Users\Username;

class UsernameTest extends \PHPUnit_Framework_TestCase {

  /** @test */
  public function should_require_username()
  {
    $this->setExpectedException('Exception');
    $username = new Username;
  }

  /** @test */
  public function should_require_valid_username()
  {
    $this->setExpectedException('DomainException');
    $username = new Username('@@@');
  }

  /** @test */
  public function should_accept_valid_username()
  {
    $username = new Username('philipbrown');
    $this->assertInstanceOf('Cribbb\Users\Username\Username', $username);
  }

}
