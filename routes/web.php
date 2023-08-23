<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::fallback(function () {
    return redirect()->route('home');
});

Route::controller(AuthController::class)->group(function () {

    Route::middleware('guest')->group(function(){

        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'doLogin');
        Route::get('/register', 'showRegistrationForm');
        Route::post('/register', 'doRegister');

    });

    Route::post('/logout', 'doLogout')->middleware('auth');

});

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
