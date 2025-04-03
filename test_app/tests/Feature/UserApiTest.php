<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserApiTest extends TestCase
{

//    use RefreshDatabase;

    private string $token = "eyJ1aWQiOjEyMywibmFtZSI6Ikx5bm4ifQ==";

    public function test_user_insert()
    {

        $data = [
            'name' => 'XXX',
            'email' => 'xxx@example.com',
            'age' => 25,
            'phone' => '0912345678',
            'password' => 'secret123'
        ];

        $response = $this->postJson('/api/users', $data, [
            'Authorization' => $this->token
        ]);
        $response->assertStatus(200)
            ->assertJsonFragment(['email' => 'xxx@example.com'])
            ->assertJsonFragment(['name' => 'XXX']);

        $this->assertDatabaseHas('users', [
            'email' => 'xxx@example.com',
            'name' => 'XXX'
        ]);

        $firstData = User::where('phone', '0912345678')->first();
        $getResponse = $this->getJson("/api/users/{$firstData->id}", [
            'Authorization' => $this->token
        ]);

        $getResponse->assertStatus(200)
            ->assertJsonFragment(['name' => 'XXX']);


    }

    public function test_user_create_validation_error()
    {
        // 少了必要欄位 email、name
        $response = $this->postJson('/api/users', [
            'age' => 30,
        ], [
            'Authorization' => $this->token
        ]);

        $response->assertStatus(400); // Laravel 預設的 validation 錯誤碼
        $response->assertJsonValidationErrors(['name', 'email']);
    }
}
