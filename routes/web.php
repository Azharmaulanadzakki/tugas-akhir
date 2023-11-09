
<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;




Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'checkUserRole:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/mapel', \App\Http\Controllers\MapelController::class);
    Route::resource('/admin/materi', \App\Http\Controllers\MateriController::class);
    Route::resource('/admin/user', \App\Http\Controllers\UserController::class);
});
