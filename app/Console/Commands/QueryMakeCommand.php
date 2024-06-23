<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Console\Concerns\CreatesMatchingTest;

class QueryMakeCommand extends GeneratorCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:query
                            {name : The class name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new query class';

    /**
     * Class type that is being created.
     */
    protected $type = 'Query';

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        // First we need to ensure that the given name is not a reserved word within the PHP
        // language and that the class name will actually be valid. If it is not valid we
        // can error now and prevent from polluting the filesystem using invalid files.
        if ($this->isReservedName($this->getNameInput())) {
            $this->components->error('The name "' . $this->getNameInput() . '" is reserved by PHP.');

            return false;
        }
        $name = $this->formatQueryName($this->qualifyClass($this->getNameInput()));


        $path = $this->getPath($name);

        // Next, We will check to see if the class already exists. If it does, we don't want
        // to create the class and overwrite the user's code. So, we will bail out so the
        // code is untouched. Otherwise, we will continue generating this class' files.
        if ((!$this->hasOption('force') ||
                !$this->option('force')) &&
            $this->alreadyExists($this->getNameInput())
        ) {
            $this->components->error($this->type . ' already exists.');

            return false;
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);

        $this->files->put($path, $this->sortImports($this->buildClass($name)));

        $info = $this->type;

        if (in_array(CreatesMatchingTest::class, class_uses_recursive($this))) {
            if ($this->handleTestCreation($path)) {
                $info .= ' and test';
            }
        }

        $this->components->info(sprintf('%s [%s] created successfully.', $info, $path));
    }

    /**
     * Replace the class name in the stub with the formatted query name.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        // Format the query name if needed
        $formattedName = $this->formatQueryName($name);
        // Call the parent method to replace the class name in the stub
        $stub = parent::replaceClass($stub, $formattedName);

        // Replace '{{ class }}' in the stub with the formatted query name
        $stub = str_replace('{{ class }}', $formattedName, $stub);

        return $stub;
    }

    /**
     * Format the provided query name to ensure it ends with 'Query'.
     *
     * @param  string  $name
     * @return string
     */
    protected function formatQueryName($name)
    {
        // Check if the name ends with 'Query' and add it if not
        if (!str_ends_with(strtolower($name), 'query')) {
            $name .= 'Query';
        }
        // dd($name);
        return $name;
    }

    /**
     * Specify your Stub's location.
     */
    protected function getStub()
    {
        $basepath = app_path() . '/Console/Commands/stubs';
        return  $basepath . '/query.stub';
    }


    /**
     * The root location where your new file should
     * be written to.
     */
    protected function getDefaultNamespace($namespace)
    {
        return $namespace . '\DB\Queries';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the query.'],
        ];
    }
}
