<?php namespace Cribbb\Users;

class PasswordTest extends \PHPUnit_Framework_TestCase {

  /** @test */
  public function should_require_password()
  {
    $this->setExpectedException('Exception');
    $password = new Password;
  }

  /** @test */
  public function should_require_valid_password()
  {
    $this->setExpectedException('DomainException');
    $password = new Password('abc');
  }

  /** @test */
  public function should_accept_valid_password()
  {
    $password = new Password('ffsfewefhwuehfuiwhfiuwiufgiuwgewiugwefiuwbw');
    $this->assertInstanceOf('Cribbb\Users\Password', $password);
  }

}
