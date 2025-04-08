<?php

namespace App\Utils;

use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\InvalidArgumentException;

class CacheRedisUtil
{
    public static function get($key, $default = null)
    {
        return Cache::store('redis')->get($key, $default);
    }

    public static function set($key, $value, $ttl = 3600): void
    {
        Cache::store('redis')->put($key, $value, $ttl);
    }

    public static function delete($key): void
    {
        Cache::store('redis')->forget($key);
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function has($key): bool
    {
        return Cache::store('redis')->has($key);
    }

    public static function flush(): void
    {
        Cache::store('redis')->flush();
    }



}
