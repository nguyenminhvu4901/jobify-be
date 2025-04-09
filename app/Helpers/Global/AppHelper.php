<?php

use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

if (!function_exists('extractEmailPrefix')) {
    /**
     * @param string $email
     * @return string
     */
    function extractEmailPrefix(string $email): string
    {
        return strstr($email, '@', true);
    }
}

if (!function_exists('getStatus')) {
    /**
     * @param int $status
     * @return bool
     */
    function getStatus(int $status): bool
    {
        return $status === 1;
    }
}

if (!function_exists('convertVideoSizToMB')) {
    /**
     * @param $requestVideo
     * @return float|int
     */
    function convertVideoSizToMB($requestVideo): float|int
    {
        return ($requestVideo->getSize() / (1024 * 1024));
    }
}

if (!function_exists('generateCacheName')) {
    /**
     * @param string $routeName
     * @param object|null $params
     * @return string|null
     */
    function generateCacheName(string $routeName, object|null $params = null): ?string
    {
        if(!empty($params)){
            $paramVars = get_object_vars($params);
            $paramString = implode('-', array_map(
                fn($key, $value) => "{$key}:{$value}", array_keys($paramVars), $paramVars
            ));

            return $routeName . '-' . $paramString;
        }

        return $routeName;
    }
}

if (!function_exists('collectionPaginate')) {
    /**
     * @param Collection $results
     * @param int $pageSize
     * @param int|null $currentPage
     * @param array $otherOptions
     * @return Closure|LengthAwarePaginator|mixed|object|null
     * @throws BindingResolutionException
     */
    function collectionPaginate(
        Collection $results,
        int $pageSize,
        int $currentPage = null,
        array $otherOptions = []
    ): mixed
    {
        $page = $currentPage ?? Paginator::resolveCurrentPage();
        $total = $results->count();
        $options = array_merge([
            'pageName' => 'page',
            'path' => config('app.url') . request()->getPathInfo(),
        ], $otherOptions);

        return Container::getInstance()->makeWith(LengthAwarePaginator::class, [
            'items' => $results->forPage($page, $pageSize),
            'total' => $total,
            'perPage' => $pageSize,
            'currentPage' => $currentPage,
            'options' => $options,
        ]);
    }
}

if (!function_exists('translatable_or_original')) {
    /**
     * @param string $key
     * @param string $value
     * @return string
     */
    function translatable_or_original(string $key, string $value): string
    {
        $translated = __($key . '.' . $value);
        return $translated !== $key . '.' . $value ? $translated : $value;
    }
}

