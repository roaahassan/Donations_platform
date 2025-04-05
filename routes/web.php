<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\NeedController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Route for showing the login form
Route::get('/login', [LoginController::class , 'showLoginForm'])->name('login');

// Route for handling the login form submission
Route::post('/login', [LoginController::class,'login']);

Route::get('/logout', [LogoutController::class, 'showLogoutButton'])->name('logout');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// admin routes

// مسارات إدارة الحوجات
Route::prefix('admin')->middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::resource('needs', NeedController::class);
    // Route for updating the collected amount
    Route::post('needs/{need}/update-collected-amount', [NeedController::class, 'updateCollectedAmount'])->name('needs.updateCollectedAmount');
});