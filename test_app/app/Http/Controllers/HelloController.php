<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $name = "Miles";
        return view('hello', ['name' => $name]);
    }

    public function testQueryString(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $name = $request->query('name', 'who');
        return view('hello', ['name' => $name]);
    }

    public function testGet(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => "hi hi"
        ]);
    }

    public function testPost(Request $request): \Illuminate\Http\JsonResponse
    {
//        $data = $request->json()->all();
//        $name = isset($data['name']) ? $data['name'] : 'Guest';
        $name = $request->json('name', 'Guest');
        return response()->json([
            'message' => "Hello, $name!"
        ]);
    }
}
