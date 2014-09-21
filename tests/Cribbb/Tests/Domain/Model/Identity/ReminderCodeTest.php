<?php namespace Cribbb\Tests\Domain\Model\Identity;

use Cribbb\Domain\Model\Identity\ReminderCode;

class ReminderCodeTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_generate_new_code()
    {
        $code = ReminderCode::generate();

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\ReminderCode', $code);
    }

    /** @test */
    public function should_create_a_code_from_a_string()
    {
        $code = ReminderCode::fromNative('D1zcA5ncaEHzmjvCGjJIt3Kd8sGxTTtE7DkathqB');

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\ReminderCode', $code);
    }

    /** @test */
    public function should_test_equality()
    {
        $one   = ReminderCode::fromNative('D1zcA5ncaEHzmjvCGjJIt3Kd8sGxTTtE7DkathqB');
        $two   = ReminderCode::fromNative('D1zcA5ncaEHzmjvCGjJIt3Kd8sGxTTtE7DkathqB');
        $three = ReminderCode::fromNative('sdffpweofpojwepfnpowefopwfpowejfpopopfep');

        $this->assertTrue($one->equals($two));
        $this->assertFalse($one->equals($three));
    }

    /** @test */
    public function should_return_as_string()
    {
        $code = ReminderCode::fromNative('D1zcA5ncaEHzmjvCGjJIt3Kd8sGxTTtE7DkathqB');

        $this->assertEquals('D1zcA5ncaEHzmjvCGjJIt3Kd8sGxTTtE7DkathqB', $code->toString());
    }
}
