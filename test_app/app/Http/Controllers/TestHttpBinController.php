<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestHttpBinController extends Controller
{
    public function testHttpBinGet(Request $request): \Illuminate\Http\JsonResponse
    {
        $all = $request->json()->all();
        $response = Http::get('https://httpbin.org/get', [
            $all
        ]);
        return response()->json([
            'success' => true,
            'status_code' => $response->status(),
            'data' => $response->json()]);
    }

    public function testHttpBinPost(Request $request): \Illuminate\Http\JsonResponse
    {
        $all = $request->json()->all();
        $response = Http::post('https://httpbin.org/post', [
            $all
        ]);
        return response()->json([
            'success' => true,
            'status_code' => $response->status(),
            'data' => $response->json()]);
    }

    public function testHttpBinDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->json('id');
        $response = Http::delete('https://httpbin.org/delete', [
            $id => 1,
        ]);
        return response()->json([
            'success' => true,
            'status_code' => $response->status(),
            'data' => $response->json()]);
    }

    public function testHttpBinPut(Request $request): \Illuminate\Http\JsonResponse
    {
        $all = $request->json()->all();
        $response = Http::put('https://httpbin.org/put', [
            $all
        ]);
        return response()->json([
            'success' => true,
            'status_code' => $response->status(),
            'data' => $response->json()]);
    }

    public function testPatch(Request $request): \Illuminate\Http\JsonResponse
    {
        $all = $request->json()->all();
        $response = Http::patch('https://httpbin.org/patch', [
            $all
        ]);

        return response()->json([
            'success' => true,
            'status_code' => $response->status(),
            'data' => $response->json()
        ]);
    }
}
