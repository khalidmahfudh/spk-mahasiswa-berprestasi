<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenerateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\KriteriaTopsisController;
use App\Http\Controllers\KriteriaAHPController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;

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

Route::middleware('guest')->group(function(){

    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'doLogin');
        Route::get('/register', 'showRegistrationForm');
        Route::post('/register', 'doRegister');
    });

});

Route::middleware('auth')->group(function(){

    Route::middleware('admin')->group(function(){
        // manage users
        Route::controller(UserController::class)->group(function () {
            Route::get('/manageusers', 'index')->name('manageusers');
            Route::get('/manageusers/create', 'create');
            Route::post('/manageusers', 'store');
            Route::get('/manageusers/detail', 'show');
            Route::delete('/manageusers/{id}', 'destroy');
            Route::get('/manageusers/{id}/edit', 'edit');
            Route::patch('/manageusers/{id}', 'update');
        });

        

        // manage kriteria
        Route::controller(KriteriaController::class)->group(function () {
            Route::get('/managekriteria', 'index')->name('managekriteria');
            Route::get('/managekriteria/create', 'create');
            Route::post('/managekriteria', 'store');
            Route::delete('/managekriteria/{id}', 'destroy');
            Route::get('/managekriteria/{id}/edit', 'edit');
            Route::patch('/managekriteria/{id}', 'update');
        });

        // manage bobot kriteria topsis
        Route::controller(KriteriaTopsisController::class)->group(function () {
            Route::get('/bobotkriteriatopsis', 'index')->name('bobotkriteriatopsis');
            Route::patch('/bobotkriteriatopsis/{id}', 'update');
        });

        // manage bobot kriteria ahp
        Route::controller(KriteriaAHPController::class)->group(function () {
            Route::get('/matrixkriteriaahp', 'index')->name('matrixkriteriaahp');
            Route::get('/matrixkriteriaahp/edit', 'edit');
            Route::patch('/matrixkriteriaahp', 'update');
        });

    });

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // manage mahasiswa
    Route::controller(MahasiswaController::class)->group(function () {
        Route::get('/managemahasiswa', 'index')->name('managemahasiswa');
        Route::get('/managemahasiswa/create', 'create');
        Route::post('/managemahasiswa', 'store');
        Route::delete('/managemahasiswa/{id}', 'destroy');
        Route::get('/managemahasiswa/{id}/edit', 'edit');
        Route::patch('/managemahasiswa/{id}', 'update');
    });
    
    Route::get('/generate', [GenerateController::class, 'index'])->name('generate');
    Route::post('/generate/process', [GenerateController::class, 'process'])->name('process');
    Route::get('/generate/result', [GenerateController::class, 'result'])->name('result');

    Route::get('/myprofile', [ProfileController::class, 'index'])->name('myprofile');
    Route::get('/myprofile/editpassword', [ProfileController::class, 'editpassword']);
    Route::get('/myprofile/editprofile', [ProfileController::class, 'editprofile']);
    Route::patch('/myprofile/updateprofile', [ProfileController::class, 'updateprofile']);
    Route::patch('/myprofile/updatepassword', [ProfileController::class, 'updatepassword']);

    Route::post('/logout', [AuthController::class, 'doLogout'])->name('logout');
    
});


