<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ShowFillable extends Command
{
    protected $signature = 'model:fillable {model}';
    protected $description = 'Show fillable fields of a model';

    public function handle()
    {
        $modelClass = $this->argument('model');

        if (!class_exists($modelClass)) {
            $this->components->error("Model class {$modelClass} does not exist.");
            return 1;
        }

        $model = new $modelClass;

        if (!method_exists($model, 'getFillable')) {
            $this->components->error("Class {$modelClass} is not a valid Eloquent model.");
            return 1;
        }

        $fillable = $model->getFillable();

        if (empty($fillable)) {
            $this->components->warn("No fillable fields defined for {$modelClass}.");
        } else {
            $this->components->info("Fillable fields for {$modelClass}:");
            foreach ($fillable as $field) {
                $this->line("- {$field}");
            }
        }

        return 0;
    }
}
