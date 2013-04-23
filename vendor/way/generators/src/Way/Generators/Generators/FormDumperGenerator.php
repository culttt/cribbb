<?php

namespace Way\Generators\Generators;

use Illuminate\Filesystem\Filesystem as File;
use Illuminate\Support\Pluralizer;
use Mustache_Engine as Mustache;

class FormDumperGenerator {

    /**
     * DB table info
     */
    protected $tableInfo;

    /**
     * File instance
     * @var Filesystem
     */
    protected $file;

    /**
     * Mustache instance
     *
     * @var Mustache_Engine
     */
    protected $mustache;

    /**
     * Path to templates dir
     *
     * @var string
     */
    protected static $templatePath;

    /**
     * Dump a new form
     *
     * @param File     $file
     * @param Mustache $mustache
     */
    public function __construct(File $file, Mustache $mustache)
    {
        $this->file = $file;
        $this->mustache = $mustache;

        static::$templatePath = __DIR__.'/../Generators/templates/dump/';
    }

    /**
     * Create the form
     * @param  string $model
     * @param  string $method
     * @param  string $element
     * @return void
     */
    public function make($model, $method, $element)
    {
        $this->tableInfo = $this->getTableInfo($model);

        $type = 'generic';
        if (preg_match('/^ul|li|ol$/i', $element))
        {
            $element = 'li';
            $type = 'list';
        }

        $output = $this->render($type, $method, $model, $element);
        $this->printOutput($output);
    }

    /**
     * Print the output to the console
     *
     * @param  string $output
     * @return void
     */
    public function printOutput($output)
    {
        print_r($output);
    }

    /**
     * Fetch a list of attributes for the
     * table, minus non-essentials.
     *
     * @param string $table
     * @return array
     */
    protected function getModelAttributes($table)
    {
        $names = array_keys($table);

        return array_diff($names, array('id', 'created_at', 'updated_at', 'password'));
    }

    /**
     * Compile templates
     *
     * @param  string $type    [description]
     * @param  string $method  [description]
     * @param  string $model   [description]
     * @param  string $element [description]
     * @return string
     */
    protected function render($type = 'list', $method, $model, $element)
    {
        $template = $this->getTemplate($type);

        return $this->mustache->render($template, array(
            'formElements' => $this->getFormElements($type, $element),
            'element'      => $element,
            'formOpen'     => $this->getFormOpen($method, $model)
        ));
    }

    /**
     * Generate form open string
     * @param  string $method
     * @param  string $model
     * @return string
     */
    protected function getFormOpen($method, $model)
    {
        $collection = Pluralizer::plural($model);

        if (preg_match('/edit|update|put|patch/i', $method))
        {
            return "{{ Form::model(\${$model}, array('method' => 'PATCH', 'route' => array('{$collection}.update', \${$model}->id))) }}";
        }

        return "{{ Form::open(array('route' => '{$collection}.store')) }}";
    }

    /**
     * Fetch Doctrine table info
     * @param  string $model
     * @return object
     */
    public function getTableInfo($model)
    {
        $table = Pluralizer::plural($model);

        return \DB::getDoctrineSchemaManager()->listTableDetails($table)->getColumns();
    }

    /**
     * Calculate correct Formbuilder method
     *
     * @param  string $name
     * @return string
     */
    public function getInputType($name)
    {
        $dataType = $this->tableInfo[$name]->getType()->getName();

        $lookup = array(
            'string'  => 'text',
            'float'   => 'text',
            'date'    => 'text',
            'text'    => 'textarea',
            'boolean' => 'checkbox'
        );

        return array_key_exists($dataType, $lookup)
            ? $lookup[$dataType]
            : 'text';
    }

    /**
     * Dynamically create form elements
     *
     * @param  string $type
     * @param  string $element
     * @return string
     */
    protected function getFormElements($type = 'list', $element)
    {
        $form = array();
        $template = $this->getTemplate("{$type}-block");
        $attributes = $this->getModelAttributes($this->tableInfo);

        foreach($attributes as $name)
        {
            $form[] = $this->renderElement($template, $element, $name);
        }

        return implode(PHP_EOL . PHP_EOL, $form);
    }

    /**
     * Render a single element block
     *
     * @param  string $block
     * @param  string $element
     * @param  string $name
     * @return string
     */
    protected function renderElement($block, $element, $name)
    {
        return $this->mustache->render($block, array(
            'element'   => $element,
            'name'      => $name,
            'type'      => $this->getInputType($name),
            'label'     => str_replace('_', ' ', ucwords($name)) . ':'
        ));
    }

    /**
     * Get a form template by name
     *
     * @param  string $type
     * @return string
     */
    protected function getTemplate($type = 'list')
    {
        return $this->file->get(static::$templatePath."/{$type}.txt");
    }

}
