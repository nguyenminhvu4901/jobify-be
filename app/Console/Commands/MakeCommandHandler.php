<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeCommandHandler extends Command
{
    protected $signature = 'make:command-handler {name}';
    protected $description = 'Create a directory inside app/Commands and generate Command & Handler files';

    public function handle(): void
    {
        $name = preg_replace('/[\/\\\\]+/', '/', trim($this->argument('name'), "/\\"));

        if (empty($name) || str_contains($name, '.')) {
            $this->components->error("Invalid name: Name cannot be empty or contain dots.");
            return;
        }

        if (!preg_match('/^[A-Za-z_][A-Za-z0-9_\/\\\\]*$/', $name)) {
            $this->components->error("Invalid name: {$name}");
            return;
        }

        $filesystem = new Filesystem();
        $basePath = app_path('Commands');

        if (!$filesystem->isDirectory($basePath)) {
            $filesystem->makeDirectory($basePath, 0755, true);
        }

        $className = class_basename($name);
        $parentPath = dirname($name);
        if ($parentPath === '.' || $parentPath === '\\' || $parentPath === '/') {
            $parentPath = '';
        }

        $finalDirectory = "{$basePath}/{$parentPath}/{$className}";

        if (!$filesystem->isDirectory($finalDirectory)) {
            $filesystem->makeDirectory($finalDirectory, 0755, true);
        }

        $namespace = "App\\Commands" . (!empty($parentPath) ? "\\" . str_replace('/', '\\', $parentPath) : "") . "\\{$className}";
        $namespace = preg_replace('/\\\\+/', '\\', $namespace);


        $commandPath = "{$finalDirectory}/{$className}Command.php";
        if (!$filesystem->exists($commandPath)) {

            $commandStub = <<<PHP
            <?php

            namespace {$namespace};

            readonly class {$className}Command
            {
            }
            PHP;

            $filesystem->put($commandPath, $commandStub);
            $this->components->info("Command [app/Commands/{$parentPath}/{$className}/{$className}Command.php] created successfully.");
        } else {
            $this->components->error("Command [app/Commands/{$parentPath}/{$className}/{$className}Command.php] already exists.");
        }

        $handlerPath = "{$finalDirectory}/{$className}Handler.php";
        if (!$filesystem->exists($handlerPath)) {

            $handlerStub = <<<PHP
            <?php

            namespace {$namespace};

            class {$className}Handler
            {
            }
            PHP;

            $filesystem->put($handlerPath, $handlerStub);
            $this->components->info("Handler [app/Commands/{$parentPath}/{$className}/{$className}Handler.php] created successfully.");
        } else {
            $this->components->error("Handler [app/Commands/{$parentPath}/{$className}/{$className}Handler.php] already exists.");
        }
    }
}
