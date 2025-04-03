<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json(['success' => false, 'message' => '未授權'], 401);
        }
        if (strpos($token, 'Bearer ') === 0) {
            $token = substr($token, 7);
        }

        // true 嚴格檢查 token 格式
        // base64_decode 很不嚴格，但如果是jwt_token是json 可以用json_decode
        $decode = base64_decode($token, true);
        $json_decode = json_decode($decode, true);
        // 因為 loose comparison 會有問題，所以這邊不用正向比較，就算是[]也會被判斷成false
        if ($json_decode === null || $decode === false) {
            return response()->json(['success' => false, 'message' => 'token格式錯誤'], 401);
        }

        // 存回 request
        $request->merge(['token_data' => $token]);
        return $next($request);
    }
}
