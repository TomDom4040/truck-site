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
use App\Http\Controllers\AdSettingsController;

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
    
    // Главная страница админ-панели
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    
    // Страница пользователей
    Route::prefix('users')->name('admin.users.')->group(function () {
        Route::get('/', [AdminController::class, 'usersIndex'])->name('index');
        Route::get('/{profile_id}', [AdminController::class, 'usersEdit'])->name('edit');
        Route::put('/{profile_id}', [AdminController::class, 'usersUpdate'])->name('update');
        Route::delete('/{profile_id}', [AdminController::class, 'usersDestroy'])->name('destroy');
    });

    // Поиск пользователей
    Route::get('search', [AdminController::class, 'search'])->name('admin.search');
    
    // Настройки объявлений
    Route::prefix('ad-settings')->name('admin.ad-settings.')->group(function () {
        Route::get('/', [AdSettingsController::class, 'index'])->name('index');
        Route::post('/city', [AdSettingsController::class, 'storeCity'])->name('storeCity');
        Route::put('/city/{id}', [AdSettingsController::class, 'updateCity'])->name('updateCity');
        Route::delete('/city/{id}', [AdSettingsController::class, 'destroyCity'])->name('destroyCity');
        
        Route::post('/category', [AdSettingsController::class, 'storeCategory'])->name('storeCategory');
        Route::put('/category/{id}', [AdSettingsController::class, 'updateCategory'])->name('updateCategory');
        Route::delete('/category/{id}', [AdSettingsController::class, 'destroyCategory'])->name('destroyCategory');

        Route::post('/storePackage', [AdSettingsController::class, 'storePackage'])->name('storePackage');
        Route::put('/updatePackage/{id}', [AdSettingsController::class, 'updatePackage'])->name('updatePackage');
        Route::delete('/destroyPackage/{id}', [AdSettingsController::class, 'destroyPackage'])->name('destroyPackage');
        Route::post('/updateSocialPrice', [AdSettingsController::class, 'updateSocialPrice'])->name('updateSocialPrice');
    });

    // Заказы
    Route::prefix('orders')->name('admin.orders.')->group(function () {
        Route::get('/', [AdminController::class, 'ordersIndex'])->name('index');
        Route::get('/{id}/edit', [AdminController::class, 'ordersEdit'])->name('edit');
        Route::delete('/{id}', [AdminController::class, 'ordersDestroy'])->name('destroy');
    });

    // Товары
    Route::prefix('products')->name('admin.products.')->group(function () {
        Route::get('/', [AdminController::class, 'productsIndex'])->name('index');
        Route::get('/{id}/edit', [AdminController::class, 'productsEdit'])->name('edit');
        Route::delete('/{id}', [AdminController::class, 'productsDestroy'])->name('destroy');
    });
});


// Отображение категорий
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Роуты для отображения всех объявлений (например, на главной странице)
Route::get('/ads', [AdController::class, 'index'])->name('ads.index');


