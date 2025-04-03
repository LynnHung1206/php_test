<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index()
    {
        $name = "Miles";
        return view('hello', ['name' => $name]);
    }

    public function testQueryString(Request $request)
    {
        $name = $request->query('name', 'who');
        return view('hello', ['name' => $name]);
    }

    public function testGet()
    {
        return response()->json([
            'message' => "hi hi"
        ]);
    }

    public function testPost(Request $request)
    {
        $data = $request->json()->all();
        $name = isset($data['name']) ? $data['name'] : 'Guest';
        return response()->json([
            'message' => "Hello, $name!"
        ]);
    }
}
