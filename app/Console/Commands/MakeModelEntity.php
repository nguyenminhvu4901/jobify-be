<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeModelEntity extends Command
{
    /**
     * @var string
     */
    protected $signature = 'make:model-entity {name}';

    /**
     * @var string
     */
    protected $description = 'Create folder and file for Entities folder';

    public function handle(): void
    {
        $name = preg_replace('/[\/\\\\]+/', '/', trim($this->argument('name'), '/\\'));

        if (! preg_match('/^[A-Za-z_][A-Za-z0-9_\/\\\\]*$/', $name)) {
            $this->components->error("Invalid entity name: {$name}");

            return;
        }

        $entityPath = app_path("Entities/{$name}.php");
        $filesystem = new Filesystem();

        if (! $filesystem->isDirectory(app_path('Entities'))) {
            $filesystem->makeDirectory(app_path('Entities'), 0755, true);
        }

        $directory = dirname($entityPath);
        if (! $filesystem->isDirectory($directory)) {
            $filesystem->makeDirectory($directory, 0755, true);
        }

        if (! $filesystem->exists($entityPath)) {
            $className = class_basename($name);
            $namespace = 'App\\Entities';

            $subNamespace = trim(str_replace('/', '\\', dirname($name)), '.');
            if ($subNamespace !== '') {
                $namespace .= "\\{$subNamespace}";
            }

            $stub = <<<PHP
<?php

namespace {$namespace};

use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class {$className} extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;
}
PHP;

            $filesystem->put($entityPath, $stub);
            $filesystem->chmod($entityPath, 0644);

            $this->components->info("Entity [app/Entities/{$name}.php] created successfully.");
        } else {
            $this->components->error("Entity [app/Entities/{$name}.php] already exists.");
        }
    }
}
