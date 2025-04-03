<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /**
     * 用戶模型實例
     */
    protected $user;

    /**
     * 建構子
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * 獲取所有用戶
     */
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return User::all();
    }

    /**
     * 根據ID獲取用戶
     */
    public function getById($id)
    {
        return User::find($id);
    }

    /**
     * 根據條件獲取用戶
     */
    public function getByCriteria(array $criteria)
    {
        return User::where($criteria)->get();
    }

    /**
     * 創建新用戶
     */
    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password'] ?? 'password');
        return User::create($data);
    }

    /**
     * 更新用戶
     */
    public function update($id, array $data)
    {
        $user = User::find($id);

        if (!$user) {
            return false;
        }

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $user->update($data);
    }

    /**
     * 刪除用戶
     */
    public function delete($id): int
    {
        return User::destroy($id);
    }
}
