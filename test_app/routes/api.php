<?php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\RedisDemoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// test redis
Route::get('/redis-demo', [RedisDemoController::class, 'index']);
// test post
Route::post('/hello', [HelloController::class, 'testPost']);
Route::get('/hello', [HelloController::class, 'testPost']);
// test validation
Route::middleware('token.auth')->group(function () {
    Route::resource('users', UserController::class);
});

Route::post('/basicAuth', [\App\Http\Controllers\AuthController::class, 'testBasicAuth']);
Route::get('/bearerAuth', [\App\Http\Controllers\AuthController::class, 'testBearerAuth']);

Route::post('testHttpBinGet', [\App\Http\Controllers\TestHttpBinController::class, 'testHttpBinGet']);
Route::post('testHttpBinPost', [\App\Http\Controllers\TestHttpBinController::class, 'testHttpBinPost']);
Route::post('testHttpBinDelete', [\App\Http\Controllers\TestHttpBinController::class, 'testHttpBinDelete']);
Route::post('testHttpBinPut', [\App\Http\Controllers\TestHttpBinController::class, 'testHttpBinPut']);
Route::post('testHttpBinPatch', [\App\Http\Controllers\TestHttpBinController::class, 'testPatch']);
