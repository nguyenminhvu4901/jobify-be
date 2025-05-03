<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeRepository extends Command
{
    protected $signature = 'make:repository {name}';

    protected $description = 'Create interface and Eloquent class for repository pattern';

    public function handle(): void
    {
        try {
            $name = preg_replace('/[\/\\\\]+/', '/', trim($this->argument('name'), '/\\'));

            if (! preg_match('/^[A-Za-z_][A-Za-z0-9_\/\\\\]*$/', $name)) {
                $this->components->error("Invalid repository name: {$name}");

                return;
            }

            $filesystem = new Filesystem();
            $repositoryPath = app_path("Repositories/{$name}");
            $className = class_basename($name);

            $namespace = 'App\\Repositories\\'.str_replace('/', '\\', trim($name, '/\\'));

            if (! $filesystem->isDirectory($repositoryPath)) {
                $filesystem->makeDirectory($repositoryPath, 0755, true);
            }

            $interfacePath = "{$repositoryPath}/{$className}Repository.php";
            if (! $filesystem->exists($interfacePath)) {

                $interfaceStub = <<<PHP
                <?php

                namespace {$namespace};

                interface {$className}Repository
                {
                }
                PHP;

                $filesystem->put($interfacePath, $interfaceStub);
                $this->components->info("Interface [{$interfacePath}] created successfully.");
            } else {
                $this->components->error("Interface [{$interfacePath}] already exists.");
            }

            $eloquentPath = "{$repositoryPath}/{$className}RepositoryEloquent.php";
            if (! $filesystem->exists($eloquentPath)) {

                $eloquentStub = <<<PHP
                <?php

                namespace {$namespace};

                use App\Repositories\BaseRepository;

                class {$className}RepositoryEloquent extends BaseRepository implements {$className}Repository
                {
                    public function model()
                    {
                        // TODO: Implement model() method.
                    }
                }
                PHP;

                $filesystem->put($eloquentPath, $eloquentStub);
                $this->components->info("Eloquent Repository [{$eloquentPath}] created successfully.");
            } else {
                $this->components->error("Eloquent Repository [{$eloquentPath}] already exists.");
            }
        } catch (Exception $e) {
            $this->components->error('An error occurred: '.$e->getMessage());
        }
    }
}
