<?php

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

if (!function_exists('storageMinIO')) {

    /**
     * @return Filesystem
     */
    function storageMinIO(): Filesystem
    {
        return Storage::disk('minio');
    }
}

if (!function_exists('bucketMinIO')) {
    /**
     * @return mixed
     */
    function bucketMinIO(): mixed
    {
        return env('MINIO_BUCKET') ?? 'jobify';
    }
}
