<?php

namespace Way\Generators\Generators;

class SeedGenerator extends Generator {

    /**
     * Fetch the compiled template for a seed
     *
     * @param  string $template Path to template
     * @param  string $className
     * @return string Compiled template
     */
    protected function getTemplate($template, $className)
    {
        $this->template = $this->file->get($template);
        $pluralModel = strtolower(str_replace('TableSeeder', '', $className));

        $this->template = str_replace('{{className}}', $className, $this->template);

        return str_replace('{{pluralModel}}', $pluralModel, $this->template);
    }

    /**
    * Updates the DatabaseSeeder file's run method to
    * call this new seed class
    * @return void
    */
    public function updateDatabaseSeederRunMethod($className)
    {
        $databaseSeederPath = app_path() . '/database/seeds/DatabaseSeeder.php';

        $content = $this->file->get($databaseSeederPath);
        $content = preg_replace("/(run\(\).+?)}/us", "$1\t\$this->call('{$className}');\n\t}", $content);

        $this->file->put($databaseSeederPath, $content);
    }

}