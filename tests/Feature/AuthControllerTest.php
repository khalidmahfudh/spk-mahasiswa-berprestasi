<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText("Login");
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            "username_email" => "admin",
            "password" => "rahasia"
        ])->assertRedirect("/home");
        $this->assertTrue(Auth::check());
    }

    public function testLoginForUserAlreadyLogin()
    {
        $user = User::find(1);

        $this->actingAs($user); 

        $response = $this->get('/login');

        $response->assertRedirect("/home");
    }

    public function testLoginValidationError()
    {
        $this->post("/login", [])
            ->assertStatus(302);
    }

    public function testLoginFailed()
    {

        $this->post("/login", [
            'username_email' => "wrong",
            "password" => "wrong"
        ])->assertStatus(302);
    }

    public function testLogout()
    {
        $user = User::find(1);

        $this->actingAs($user); 

        $response = $this->post('/logout');

        $response->assertRedirect("/login");

    }
}
