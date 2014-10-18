<?php namespace Cribbb\Application\Tests;

use stdClass;
use Illuminate\Container\Container;
use Cribbb\Application\LaravelContainer;

class LaravelContainerTest extends \PHPUnit_Framework_TestCase
{
    /** @var LaravelContainer */
    private $container;

    public function setUp()
    {
        $container = new Container;
        $container->bind('Cat', function () {
            $cat = new stdClass;
            $cat->name = 'lolcat';
            return $cat;
        });

        $this->container = new LaravelContainer($container);
    }

    /** @test */
    public function should_make_class_from_container()
    {
        $class = $this->container->make('Cat');

        $this->assertInstanceOf('stdClass', $class);
        $this->assertEquals('lolcat', $class->name);
    }
}
