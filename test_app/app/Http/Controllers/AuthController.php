<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function testBasicAuth(Request $request): \Illuminate\Http\JsonResponse
    {
        // laravel內部有做緩存優化，所以不用all 也沒關係
        $user = $request->json('user', 'user');
        $passwd = $request->json('passwd', 'passwd');

        $response = Http::withBasicAuth($user, $passwd)->
            get('https://httpbin.org/basic-auth/user/passwd');

        return response()->json([
            'success' => true,
            'status_code' => $response->status(),
            'data' => $response->json()
        ]);
    }

    public function testBearerAuth(): \Illuminate\Http\JsonResponse
    {
        $response = Http::withToken('Bearer token')
            ->get('https://httpbin.org/bearer');

        return response()->json([
            'success' => true,
            'status_code' => $response->status(),
            'data' => $response->json()
        ]);
    }
}
