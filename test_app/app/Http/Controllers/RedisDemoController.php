<?php

namespace App\Http\Controllers;

use App\Utils\CacheRedisUtil;
use Exception;
use Illuminate\Http\Request;
use App\Utils\RedisUtil;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class RedisDemoController extends Controller
{

    /**
     * 測試redis連線
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $key = "hi";
        RedisUtil::set($key, "hihihi", 10);
        //sleep(11); //測試ttl作用
        $value = RedisUtil::get($key, "nothing");
        return response()->json([
            'message' => 'test get redis data',
            'value' => $value
        ]);
    }

    /**
     * 使用cache facade
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function useCacheFacade(Request $request): \Illuminate\Http\JsonResponse
    {
        $key = "hihi";

        CacheRedisUtil::set($key, "hihihihihi", 10);
        //sleep(11); //測試ttl作用
        $value = CacheRedisUtil::get($key, "nothing");
        return response()->json([
            'message' => 'test set redis data',
            'counter' => $value
        ]);
    }
}
