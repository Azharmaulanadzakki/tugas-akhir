<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WelcomeController;


Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::get('/materi/{parent_id}', [HomeController::class, 'materi'])->name('materi');
    Route::get('/tools', [HomeController::class, 'tools'])->name('tools');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', function () {
        $user = auth()->user(); // Mendapatkan pengguna yang sedang login
        return view('profile', compact('user'));
    })->name('profile.show');
    Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
});

Route::middleware(['auth', 'checkUserRole:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::resource('/admin/mapel', \App\Http\Controllers\MapelController::class);
    Route::resource('/admin/materi', \App\Http\Controllers\MateriController::class);
    Route::resource('/admin/tool', \App\Http\Controllers\ToolController::class);
    Route::resource('/admin/user', \App\Http\Controllers\UserController::class);
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
});

Route::fallback(function () {
    return view('errors.404');
});
