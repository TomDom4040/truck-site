<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // Импортируем для генерации UUID

class RegisterController extends Controller
{
    // Метод отображения формы регистрации
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Метод обработки регистрации
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'accept_terms' => 'accepted',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Генерация кода подтверждения
        $verificationCode = rand(100000, 999999);
    
        // Генерация уникального ID для пользователя
        $userId = Str::uuid(); // UUID для пользователя

        // Проверка на уникальность ID в базе данных
        while (User::where('profile_id', $userId)->exists()) {  // Убираем лишний пробел
            $userId = Str::uuid(); // Если ID уже существует, генерируем новый
        }

        // Создание нового пользователя
        $user = User::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'verification_code' => $verificationCode,  // Код подтверждения
            'email_verified_status' => 'pending',  // Статус по умолчанию
            'profile_id' => $userId, // Генерация уникального идентификатора профиля (удаляем лишний пробел)
        ]);
    
        // Отправка email с кодом подтверждения
        Mail::to($user->email)->send(new VerificationMail($verificationCode));
    
        // Сохраняем email в сессии для последующего использования
        session(['email' => $user->email]); // Явно сохраняем email в сессии

        // Перенаправление на страницу подтверждения
        return redirect()->route('verify.email');
    }

    // Метод для отображения формы подтверждения email
    public function showVerifyEmailForm(Request $request)
    {
        $email = session('email'); // Получаем email из сессии

        if (!$email) {
            return redirect()->route('register');
        }
    
        return view('auth.verify-email', ['email' => $email]);
    }

    // Метод для обработки подтверждения email
    public function verifyEmail(Request $request)
    {
        // Валидация кода
        $request->validate(['code' => 'required|size:6']);
        
        // Получаем email из сессии
        $email = session('email');

        // Проверка, существует ли email в сессии
        if (!$email) {
            return redirect()->route('register')->withErrors(['email' => 'Email не найден в сессии']);
        }

        // Проверка кода подтверждения в базе данных
        $user = User::where('email', $email)
                    ->where('verification_code', $request->input('code'))
                    ->first();

        if (!$user) {
            return redirect()->back()->withErrors(['code' => 'Неверный код подтверждения']);
        }

        // Обновление данных пользователя: подтверждение email
        $user->update([
            'email_verified_at' => now(),
            'verification_code' => null, // Убираем код подтверждения
            'email_verified_status' => 'verified', // Статус подтверждения
        ]);

        // Авторизация пользователя
        Auth::login($user); // Авторизуем пользователя

        // Перенаправление на главную страницу с сообщением о подтверждении почты
        return redirect('/')->with('status', 'Почта успешно подтверждена!');
    }
}
