<?php

use Way\Generators\Generators\FormDumperGenerator;
use Illuminate\Filesystem\Filesystem as File;
use Mockery as m;
use Mustache_Engine as Mustache;

class FormDumperGeneratorTest extends PHPUnit_Framework_TestCase {
    public function tearDown()
    {
        m::close();
    }

    public function testBasicFormCreateDump()
    {
        $form = $this->getPartialMock();

        $form->shouldReceive('getInputType')
             ->once()
             ->andReturn('text');

        $form->shouldReceive('printOutput')
             ->once()
             ->with(file_get_contents(__DIR__.'/stubs/dump/form-create.txt'));

        $form->make('dog', 'create', 'li');
    }

    public function testBasicFormUpdateDump()
    {
        $form = $this->getPartialMock();

        $form->shouldReceive('getInputType')
             ->once()
             ->andReturn('text');

        $form->shouldReceive('printOutput')
             ->once()
             ->with(file_get_contents(__DIR__.'/stubs/dump/form-update.txt'));

        $form->make('dog', 'put', 'li');
    }

    public function testCanUseCustomHTML()
    {
        $form = $this->getPartialMock();

        $form->shouldReceive('getInputType')
             ->once()
             ->andReturn('text');

        $form->shouldReceive('printOutput')
             ->once()
             ->with(file_get_contents(__DIR__.'/stubs/dump/form-create-div.txt'));

        $form->make('dog', 'create', 'div');
    }

    protected function getPartialMock()
    {
        $form = m::mock('Way\Generators\Generators\FormDumperGenerator', array(new File, new Mustache))->makePartial();

        $form->shouldReceive('getTableInfo')
             ->once()
             ->with('dog')
             ->andReturn(['name' => 'string']);

        return $form;
    }
}