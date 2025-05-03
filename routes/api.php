<?php

use Illuminate\Support\Facades\File;

$routeFiles = File::allFiles(__DIR__.'/apiRoutes');

foreach ($routeFiles as $file) {
    if ($file->getExtension() === 'php') {
        require_once $file->getPathname();
    }
}
