<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeService extends Command
{
    /**
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * @var string
     */
    protected $description = 'Create folder and file for Services folder';

    public function handle(): void
    {
        $name = preg_replace('/[\/\\\\]+/', '/', trim($this->argument('name'), '/\\'));

        if (! preg_match('/^[A-Za-z_][A-Za-z0-9_\/\\\\]*$/', $name)) {
            $this->components->error("Invalid service name: {$name}");

            return;
        }

        $servicePath = app_path("Services/{$name}.php");
        $filesystem = new Filesystem();

        if (! $filesystem->isDirectory(app_path('Services'))) {
            $filesystem->makeDirectory(app_path('Services'), 0755, true);
        }

        $directory = dirname($servicePath);
        if (! $filesystem->isDirectory($directory)) {
            $filesystem->makeDirectory($directory, 0755, true);
        }

        if (! $filesystem->exists($servicePath)) {
            $className = class_basename($name);
            $namespace = 'App\\Services';

            $subNamespace = trim(str_replace('/', '\\', dirname($name)), '.');
            if ($subNamespace !== '') {
                $namespace .= "\\{$subNamespace}";
            }

            $stub = <<<PHP
<?php

namespace {$namespace};

class {$className}
{

}
PHP;
            $filesystem->put($servicePath, $stub);

            $filesystem->chmod($servicePath, 0644);

            $this->components->info("Service [app/Services/{$name}.php] created successfully.");
        } else {
            $this->components->error("Service [app/Services/{$name}.php] already exists.");
        }
    }
}
