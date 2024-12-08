<?php

use App\Http\Controllers\API\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

$routeFiles = File::glob(__DIR__ . '/apiRoutes/*.php');

foreach ($routeFiles as $routeFile) {
    require_once $routeFile;
}
