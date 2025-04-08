<?php

use Illuminate\Support\Facades\File;

$routeFiles = File::glob(__DIR__ . '/apiRoutes/*.php');

foreach ($routeFiles as $routeFile) {
    require_once $routeFile;
}
