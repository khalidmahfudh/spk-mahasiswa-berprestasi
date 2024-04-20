<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Services\UserService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;

class AuthController extends Controller
{
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function showLoginForm (): Response
    {
        return response()->view("login", [
            "title" => "Halaman Login"
        ]);
    }

    public function doLogin (LoginRequest $request): RedirectResponse
    {

        $username_email = $request->input('username_email');
        $password = $request->input('password');
        $remember = $request->has('remember-me');
    
        if ($this->userService->login($username_email, $password, $remember)) {
            return redirect()->intended('/home');
        } else {
            return redirect()->route('login')->with('error', 'Login gagal. Mohon periksa kembali username, password, atau status akun Anda.')->withInput($request->except('password'));
        }

    }

    public function showRegistrationForm () 
    {
        return response()->view("register", [
            "title" => "Halaman Registrasi"
        ]);
    }

    public function doRegister (RegistrationRequest $request): RedirectResponse
    {
        if ($this->userService->register($request)) {
            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silahkan melakukan login.');
        } else {
            return back()->withInput()->with('error', 'Registrasi gagal. Silahkan coba lagi.');
        }
    }

    public function doLogout (Request $request): RedirectResponse
    {
        $this->userService->logout($request);

        return redirect('/login')->with('success', 'Logout berhasil');
    }

}
