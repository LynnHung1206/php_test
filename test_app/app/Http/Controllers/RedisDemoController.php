<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RedisDemoController extends Controller
{
    public function index(Request $request)
    {
        $key = "hi";
        Redis::set($key, 'hihihi');
        $value = Redis::get($key);
        return response()->json([
            'message' => 'Counter updated',
            'counter' => $value
        ]);
    }
}
