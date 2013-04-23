<?php

use Way\Generators\Generators\ControllerGenerator;
use Mockery as m;

class ControllerGeneratorTest extends PHPUnit_Framework_TestCase {
    protected static $templatesDir;

    public function __construct()
    {
        static::$templatesDir = __DIR__.'/../../src/Way/Generators/Generators/templates';
    }

    public function tearDown()
    {
        m::close();
    }

    public function testCanGenerateControllerUsingDefaultTemplate()
    {
        $file = m::mock('Illuminate\Filesystem\Filesystem')->makePartial();
        $cache = m::Mock('Way\Generators\Cache');

        $file->shouldReceive('put')
             ->once()
             ->with('app/controllers/FooController.php', file_get_contents(__DIR__.'/stubs/controller.txt'));

        $generator = new ControllerGenerator($file, $cache);
        $generator->make('app/controllers/FooController.php', static::$templatesDir.'/controller.txt');
    }

    public function testCanGenerateControllerUsingCustomTemplate()
    {
        $file = m::mock('Illuminate\Filesystem\Filesystem')->makePartial();
        $cache = m::Mock('Way\Generators\Cache');

        $file->shouldReceive('put')
             ->once()
             ->with('app/controllers/FoosController.php', file_get_contents(__DIR__.'/stubs/scaffold/controller.txt'));

        $generator = new ControllerGenerator($file, $cache);
        $generator->make('app/controllers/FoosController.php', static::$templatesDir.'/scaffold/controller.txt');
    }
}