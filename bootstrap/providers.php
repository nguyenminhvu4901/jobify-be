<?php

return [
    App\Providers\AppServiceProvider::class,
    Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
    App\Providers\RepositoryServiceProvider::class,
    Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
    Joselfonseca\LaravelTactician\Providers\LaravelTacticianServiceProvider::class,
    Prettus\Repository\Providers\RepositoryServiceProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
];
