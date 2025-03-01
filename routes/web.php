<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileEditController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\User\ProfileSettingsController;
use App\Http\Controllers\User\EmailUpdateController;
use App\Http\Controllers\User\PasswordUpdateController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;

// Главная страница
Route::get('/', [MainController::class, 'index'])->name('home');

// Маршруты для входа
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
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
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink']);
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'resetPassword']);

// Группа маршрутов, доступных только аутентифицированным пользователям
Route::middleware(['auth'])->group(function () {
    
    // Маршрут для отображения профиля по уникальному profile_id
    Route::get('/profile/{profile_id}', [UserController::class, 'showProfile'])->name('user.profile');
    
    // Маршрут для редактирования профиля
    Route::get('/profile-edit', [ProfileEditController::class, 'edit'])->name('profile.edit');
    
    // Маршрут для обновления профиля
    Route::post('/profile-update', [ProfileEditController::class, 'update'])->name('profile.update');
    
    // Страница создания объявления
    Route::get('/ads/create', [AdController::class, 'create'])->name('ads.create');
    
    // Сохранение объявления
    Route::post('/ads', [AdController::class, 'store'])->name('ads.store');

    // Страница с моими объявлениями
    Route::get('/ads/my', [AdController::class, 'myAds'])->name('ads.my');
    
    // Страница оплаты объявления
    Route::get('/ads/payment/{ad}', [AdController::class, 'payment'])->name('ads.payment');
   
    Route::get('/profile-settings', [ProfileSettingsController::class, 'index'])->name('profile-settings');
    Route::post('/profile-settings/update-email', [EmailUpdateController::class, 'sendVerificationCode'])->name('settings.sendVerificationCode');
    Route::post('/profile-settings/verify-email', [EmailUpdateController::class, 'update'])->name('settings.updateEmail');
    Route::post('/profile-settings/update-password', [PasswordUpdateController::class, 'update'])->name('settings.updatePassword');


});
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    // Остальные маршруты
   
    // Пользователи
    Route::get('/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');
    Route::get('/users/{id}/edit', [AdminController::class, 'usersEdit'])->name('admin.users.edit');
    Route::delete('/users/{id}', [AdminController::class, 'usersDestroy'])->name('admin.users.destroy');
 
 // Заказы
 Route::get('/orders', [AdminController::class, 'ordersIndex'])->name('admin.orders.index');
 Route::get('/orders/{id}/edit', [AdminController::class, 'ordersEdit'])->name('admin.orders.edit');
 Route::delete('/orders/{id}', [AdminController::class, 'ordersDestroy'])->name('admin.orders.destroy');

 // Товары
 Route::get('/products', [AdminController::class, 'productsIndex'])->name('admin.products.index');
 Route::get('/products/{id}/edit', [AdminController::class, 'productsEdit'])->name('admin.products.edit');
 Route::delete('/products/{id}', [AdminController::class, 'productsDestroy'])->name('admin.products.destroy');
});

// Отображение категорий
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Роуты для отображения всех объявлений (например, на главной странице)
Route::get('/ads', [AdController::class, 'index'])->name('ads.index');


