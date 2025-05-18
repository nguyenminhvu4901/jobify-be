<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\DateTimeZoneServiceProvider::class,
    App\Providers\HorizonServiceProvider::class,
    App\Providers\MacroServiceProvider::class,
    App\Providers\ObserverServiceProvider::class,
    App\Providers\RateLimitServiceProvider::class,
    App\Providers\RelationshipServiceProvider::class,
    App\Providers\RepositoryServiceProvider::class,
    App\Providers\TelescopeServiceProvider::class,
    Joselfonseca\LaravelTactician\Providers\LaravelTacticianServiceProvider::class,
    Prettus\Repository\Providers\RepositoryServiceProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
    Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
    Mews\Purifier\PurifierServiceProvider::class,
];
