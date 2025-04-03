<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Utils\CacheUtil;
use Illuminate\Support\Facades\Log;

class RedisDemoController extends Controller
{
    public function index(Request $request)
    {
        $key = "hi";
        CacheUtil::set($key, "hihihi", 10);
//        sleep(11); 測試ttl作用
        $value = CacheUtil::get($key, "nothing");
        return response()->json([
            'message' => 'test get redis data',
            'counter' => $value
        ]);
    }
}
