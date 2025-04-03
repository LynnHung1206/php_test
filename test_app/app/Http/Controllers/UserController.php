<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        // todo insert db

        return response()->json([
            'success' => true,
            'message' => '資料已成功儲存',
            'data' => $validated,
        ]);
    }
}
