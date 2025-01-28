<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileEditController;

Route::get('/', [MainController::class, 'index']);

// Маршруты для входа
// Страница входа
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Обработка входа
Route::post('/login', [LoginController::class, 'login']);

// Выход из системы
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Маршруты для регистрации
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    
    // Страница подтверждения email
    
    Route::get('/verify-email', [RegisterController::class, 'showVerifyEmailForm'])->name('verify.email');
    Route::post('/verify-email', [RegisterController::class, 'verifyEmail']);
});

// Маршруты для сброса пароля
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset']);


Route::middleware(['auth'])->group(function () {
    // Маршрут для отображения профиля по уникальному profile_id
    Route::get('/profile/{profile_id}', [UserController::class, 'showProfile'])->name('user.profile');

    
    // Маршрут для редактирования профиля
    Route::get('/profile-edit', [ProfileEditController::class, 'edit'])->name('profile.edit');
    
    // Маршрут для обновления профиля
    Route::post('/profile-update', [ProfileEditController::class, 'update'])->name('profile.update');
});