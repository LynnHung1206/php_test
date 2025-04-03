<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getAll();

        return response()->json([
            'success' => true,
            'data' => $users,
        ]);
    }

    public function show($id)
    {
        $user = $this->userRepository->getById($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => '找不到該用戶',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $user,
        ]);
    }

    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        $user = $this->userRepository->create($validated);

        return response()->json([
            'success' => true,
            'message' => '資料已成功儲存',
            'data' => $user,
        ]);
    }
    public function update(UserRequest $request, $id)
    {
        $validated = $request->validated();

        $success = $this->userRepository->update($id, $validated);

        if (!$success) {
            return response()->json([
                'success' => false,
                'message' => '找不到該用戶',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => '用戶已成功更新',
        ]);
    }
    public function destroy($id)
    {
        $success = $this->userRepository->delete($id);

        if (!$success) {
            return response()->json([
                'success' => false,
                'message' => '找不到該用戶',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => '用戶已成功刪除',
        ]);
    }
}
