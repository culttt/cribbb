<?php

use Way\Generators\Commands\ModelGeneratorCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Mockery as m;

class ModelGeneratorCommandTest extends PHPUnit_Framework_TestCase {
    public function tearDown()
    {
        m::close();
    }
    public function testGeneratesModelSuccessfully()
    {
        $gen = m::mock('Way\Generators\Generators\ModelGenerator');

        $gen->shouldReceive('make')
            ->once()
            ->with('app/models/Foo.php', m::any())
            ->andReturn(true);

        $command = new ModelGeneratorCommand($gen);

        $tester = new CommandTester($command);
        $tester->execute(['name' => 'foo']);

        $this->assertEquals("Created app/models/Foo.php\n", $tester->getDisplay());
    }

    public function testAlertsUserIfModelGenerationFails()
    {
        $gen = m::mock('Way\Generators\Generators\ModelGenerator');

        $gen->shouldReceive('make')
            ->once()
            ->with('app/models/Foo.php', m::any())
            ->andReturn(false);

        $command = new ModelGeneratorCommand($gen);

        $tester = new CommandTester($command);
        $tester->execute(['name' => 'Foo']);

        $this->assertEquals("Could not create app/models/Foo.php\n", $tester->getDisplay());
    }

    public function testCanAcceptCustomPathToModelsDirectory()
    {
        $gen = m::mock('Way\Generators\Generators\ModelGenerator');

        $gen->shouldReceive('make')
            ->once()
            ->with('app/foo/models/Foo.php', m::any());

        $command = new ModelGeneratorCommand($gen);

        $tester = new CommandTester($command);
        $tester->execute(['name' => 'foo', '--path' => 'app/foo/models']);
    }
}