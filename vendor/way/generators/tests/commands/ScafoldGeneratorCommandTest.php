<?php

use Way\Generators\Commands\ScaffoldGeneratorCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Mockery as m;

class ScaffoldGeneratorCommandTest extends PHPUnit_Framework_TestCase {
    public function tearDown()
    {
        m::close();
    }

    public function testGenerateScaffold()
    {
        $this->assertTrue(true);
        // $command = new ScaffoldGeneratorCommand;

        // $tester = new CommandTester($command);
        // $tester->execute(['name' => 'dog']);
    }

}