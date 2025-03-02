<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\ObserverServiceProvider::class,
    App\Providers\RepositoryServiceProvider::class,
    Joselfonseca\LaravelTactician\Providers\LaravelTacticianServiceProvider::class,
    Prettus\Repository\Providers\RepositoryServiceProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
    Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
];
