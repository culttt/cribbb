<?php

use Way\Generators\Commands\ControllerGeneratorCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Mockery as m;

class ControllerGeneratorCommandTest extends PHPUnit_Framework_TestCase {
    public function tearDown()
    {
        m::close();
    }

    public function testGeneratesController()
    {
        $gen = m::mock('Way\Generators\Generators\ControllerGenerator');
        $gen->shouldReceive('make')
            ->once()
            ->with('app/controllers/FooController.php', 'foo')
            ->andReturn(true);

        $command = new ControllerGeneratorCommand($gen);

        $tester = new CommandTester($command);
        $tester->execute(['name' => 'FooController', '--template' => 'foo']);

        $this->assertEquals("Created app/controllers/FooController.php\n", $tester->getDisplay());
    }

    public function testCanSetCustomPath()
    {
        $gen = m::mock('Way\Generators\Generators\ControllerGenerator[make]');
        $gen->shouldReceive('make')->once()->andReturn(true);

        $command = new ControllerGeneratorCommand($gen);

        $tester = new CommandTester($command);
        $tester->execute(['name' => 'FooController', '--path' => 'app', '--template' => 'foo']);

        $this->assertEquals("Created app/FooController.php\n", $tester->getDisplay());
    }

    public function testCanSetCustomStub()
    {
        $gen = m::mock('Way\Generators\Generators\ControllerGenerator[make]');
        $gen->shouldReceive('make')
            ->once()
            ->with('app/controllers/FooController.php', 'foo')
            ->andReturn(true);

        $command = new ControllerGeneratorCommand($gen);

        $tester = new CommandTester($command);
        $tester->execute(['name' => 'FooController', '--template' => 'foo']);
    }

}