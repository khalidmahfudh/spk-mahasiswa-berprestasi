<?php

namespace Tests\Feature;

use App\Services\UserService;
use Database\Seeders\UserSeeder;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    public function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);

        User::truncate();
    }

    public function testLoginSuccessWithUsername()
    {
        $this->seed([UserSeeder::class]);

        self::assertTrue($this->userService->login("khalidmahfudh", "rahasia", true));
    }

    public function testLoginSuccessWithEmail()
    {
        $this->seed([UserSeeder::class]);

        self::assertTrue($this->userService->login("john@gmail.com", "rahasia", false));
    }

    public function testLoginUserNotFound()
    {
        self::assertFalse($this->userService->login("balmond", "cihuyy", false));
    }

    public function testLoginWrongPassword()
    {
        self::assertFalse($this->userService->login("khalidmahfudz", "salah", false));
    }


}
