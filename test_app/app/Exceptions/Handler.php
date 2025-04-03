<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * 參數驗證失敗時使用 400 並且回傳 json 格式(未改寫則走laravel預設422)
     * 紀錄 錯誤日誌
     * @return void
     */
    public function register(): void
    {
        $this->renderable(function (ValidationException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => '請求參數驗證失敗',
                    'errors' => $e->errors(),
                ], 400);
            }
        });
        $this->reportable(function (Throwable $e) {
            Log::error($e->getMessage(), [
                'exception' => $e,
                'url' => request()->fullUrl(),
                'input' => request()->all()
            ]);
        });
    }
}
