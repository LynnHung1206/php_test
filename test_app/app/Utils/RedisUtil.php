<?php

namespace App\Utils;

use Illuminate\Support\Facades\Redis;

class RedisUtil
{
    public static function set($key, $value, $ttl = 3600)
    {
        Redis::set($key, $value);
        Redis::expire($key, $ttl);
    }

    public static function get($key, $default = null)
    {
        $value = Redis::get($key);
        return $value !== null ? $value : $default;
    }

    public static function delete($key)
    {
        Redis::del($key);
    }
}
