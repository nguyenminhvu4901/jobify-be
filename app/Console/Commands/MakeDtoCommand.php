<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeDtoCommand extends Command
{
    protected $signature = 'make:dto {name}';
    protected $description = 'Create a new Data Transfer Object (DTO) class';

    public function handle(): void
    {
        $name = trim($this->argument('name'));

        $name = Str::of($name)->replace(['\\', '/'], '\\')->ucfirst();
        $className = $name->afterLast('\\');
        $namespacePath = $name->beforeLast('\\')->__toString();

        $namespace = 'App\\DataTransferObjects' . ($namespacePath ? '\\' . $namespacePath : '');
        $path = app_path('DataTransferObjects/' . ($namespacePath ? str_replace('\\', '/', $namespacePath) . '/' : '') . $className . '.php');

        if (File::exists($path)) {
            $this->error("DTO {$className} already exists!");
            return;
        }

        File::ensureDirectoryExists(dirname($path));

        $stub = <<<PHP
<?php

namespace {$namespace};

readonly class {$className}
{
    //
}
PHP;

        File::put($path, $stub);

        $this->components->info("DTO {$className} created at {$path}");
    }
}
